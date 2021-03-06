var Result = Backbone.Model.extend({
    idAttribute: "id",
    initialize: function () {
        console.log('Result has been initialized');
        this.on("invalid", function (model, error) {
            console.log("Old brother, we have a problem: " + error)
        });
    },
    constructor: function (attributes, options) {
        console.log('Result\'s constructor had been called');
        Backbone.Model.apply(this, arguments);
    },
    urlRoot: 'api/results/id'
});

var Results = Backbone.Collection.extend({
	model: Result
    , url: 'api/results',
    parse: function(data) {
    	return data;
    }
});

var PageableResults = Backbone.PageableCollection.extend({
	model: Result
	, url: 'api/results',
	state: {
		pageSize: 14
	},
	mode: "client"
});

/**
 * added table header
 */
var ResultView = Backbone.View.extend({
	tagName: 'tr',
	template: _.template('<td><%= id %></td> \
						  <td><%= a_group %></td> \
						  <td><%= b_group %></td> \
						  <td><%= c_group %></td> \
						  <td><%= d_group %></td> \
						  <td><%= e_group %></td> \
						  <td><%= start_time %></td> \
						  <td><%= end_time %></td>'),
	initialize: function () {
		this.listenTo(this.model, 'change', this.render);
	},
	render: function( ) {
		this.$el.html( this.template( this.model.toJSON() ) );
		return this;
	}
});

var ResultsView = Backbone.View.extend({
	initialize: function() {
		this.listenTo(this.collection, 'add',   this.addOne);
        this.listenTo(this.collection, 'reset', this.render);
        this.views = [];
	},
	addOne: function (result) {
		var view = new ResultView({ model: result });
        this.$el.append(view.render().$el);
        this.views.push(view);
	},
	render: function () {
		var _this = this;
        _.each(this.views,function(view){
            view.remove().off();
        });

        this.views =[];
        this.$el.empty();

        this.collection.each(function(model){
            _this.addOne(model);
        });

		return this;
	}
});

var result = null;
var results = null;
var resultlist = null;
var pageableresults = null;
var pageableresultlist = null;

//modal centralize
function center_modal(my_modal) {
	$(my_modal).on('shown.bs.modal', function(){
		var $this = $(this);
		var $modal_dialog = $this.find('.modal-dialog');
		var m_top = ( $(document).height() - $modal_dialog.height() )/2;
		$modal_dialog.css({'margin': m_top + 'px auto'});
	});
}

//load and rend results to table
function list_results() {
	results = new Results();
    resultlist = new ResultsView({
        collection : results,
        el: '#resultlist'
    });

    resultlist.render();
    results.fetch();
}

var columns = [{
	name: "id",
	label: "ID",
	editable: false,
	sortable: false,
	cell: Backgrid.IntegerCell.extend({
        orderSeparator: ''
    })
}, {
	name: "a_group",
	label: "A Group",
	editable: false,
	cell: "string"
}, {
	name: "b_group",
	label: "B Group",
	editable: false,
	cell: "string"
}, {
	name: "c_group",
	label: "C Group",
	editable: false,
	cell: "string"
}, {
	name: "d_group",
	label: "D Group",
	editable: false,
	cell: "string"
}, {
	name: "e_group",
	label: "E Group",
	editable: false,
	cell: "string"
}, {
	name: "start_time",
	label: "Start",
	editable: false,
	cell: "date"
}, {
	name: "end_time",
	label: "End",
	editable: false,
	cell: "date",
	sortable: false
}];

//load and rend results to table-impl2-Backgrid
function list_results_2() {
	results = new Results();
    resultlist = new Backgrid.Grid({
    	columns: columns,
        collection: results,
        className: "backgrid table table-hover"
    });

    $("#resultlist").append(resultlist.render().el);
    results.fetch({reset: true});

    pageableresults.fetch({reset: true});
}

//load and rend results to table-impl3-Backgrid-paginator
function list_results_3() {
    pageableresults = new PageableResults();
    pageableresultlist = new Backgrid.Grid({
    	// columns: [{
    	// 	name: "",
    	// 	cell: "select-row",
    	// 	headerCell: "select-all"
    	// }].concat(columns),
    	columns: columns,
    	collection: pageableresults,
    	className: "backgrid table table-hover"
    });

    $("#resultlist").append(pageableresultlist.render().el);
	
	var paginator = new Backgrid.Extension.Paginator({
	    collection: pageableresults
	});
	$("#resultlist").after(paginator.render().el);

	var filter = new Backgrid.Extension.ClientSideFilter({
  		collection: pageableresults,
  		placeholder: "Occurrence in the 1st group",
  		fields: ['a_group']
	});
	$("#resultlist").before(filter.render().el);
	$(filter.el).css({float: "right", margin: "2px"});

    pageableresults.fetch({reset: true});
}

$(function () {
	$(document).ready(function(){
        list_results_3();
    })

    // $('#start').click(function(){
    // 	list_results();
    // })

    $('#refresh').click(function(){
        // results.fetch({ reset : true });
        pageableresults.fetch({ reset : true });
    })
    
    $('#new').click(function(){
    	$("#status").hide();
    })
    
    $('#save').click(function(){
    	// POST (create)
		var newResult = new Result({
			"a_group": $('#a_group').val(),
			"b_group": $('#b_group').val(),
			"c_group": $('#c_group').val(),
			"d_group": $('#d_group').val(),
			"e_group": $('#e_group').val(),
			"start_time": $('#start_time').val(),
			"end_time": $('#end_time').val()
		}).save();
		$("#status").show();
    })

    $('#delete').click(function(){
        // DELETE (destroy)
        var id = $('#id').val();
		
        if ( id == '') {
        	$('#alert').modal('show');
        	return center_modal('#alert');
        } 

		var result = new Result({id: id});
		result.fetch({
			error: function () {
				$('#non_exist_alert').modal('show');
				center_modal('#non_exist_alert');
			},
			success: function () {
				$('#delResult').modal('show');
				center_modal('#delResult');
			}
		}) 
    })

    $('#del_confirm').click(function(){
        // DELETE (destroy)
		var delResult = new Result({id: $('#id').val()}).destroy();
		$('#delResult').modal('hide');
    })

    /**
     * 点击编辑按钮，查询数据库，加载数据到模态框
     */
    $('#edit').click(function(){
    	//更新状态前隐藏提示信息
    	$("#edit_status").hide();

    	var id = $('#id').val();
    	if ( id == '') {
        	$('#alert').modal('show');
        	return center_modal('#alert');
        } 

    	var result = new Result({id: id});
		result.fetch({
		    success: function (resultResponse) {
		    	$('#editResult').modal('show');
		        $('#edit_id').val(resultResponse.get('id'));
		        $('#edit_a_group').val(resultResponse.get('a_group'));
		        $('#edit_b_group').val(resultResponse.get('b_group'));
		        $('#edit_c_group').val(resultResponse.get('c_group'));
		        $('#edit_d_group').val(resultResponse.get('d_group'));
		        $('#edit_e_group').val(resultResponse.get('e_group'));
		        $('#edit_start_time').val(resultResponse.get('start_time'));
		        $('#edit_end_time').val(resultResponse.get('end_time'));
		    },
		    error: function () {
				$('#non_exist_alert').modal('show');
				center_modal('#non_exist_alert');
			}
		});
    })

    $('#update').click(function(){
    	// PUT (update)
		var updateResult = new Result({
			"id": $('#edit_id').val(),
			"a_group": $('#edit_a_group').val(),
			"b_group": $('#edit_b_group').val(),
			"c_group": $('#edit_c_group').val(),
			"d_group": $('#edit_d_group').val(),
			"e_group": $('#edit_e_group').val(),
			"start_time": $('#edit_start_time').val(),
			"end_time": $('#edit_end_time').val()
		}).save();

		//显示状态信息：成功或失败
		$("#edit_status").show();
    })
})