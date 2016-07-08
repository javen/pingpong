<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>最终赛果 Final Result</title>
    <!-- Bootstrap Core CSS -->
    <link href="bnbs/css/bootstrap.min.css" rel="stylesheet">
    <link href="bnbs/css/backgrid.css" rel="stylesheet">
</head>

<body>
<div class="container">

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
			    <tr>
			        <th>#</th>
			        <th>第一组 A GROUP</th>
			        <th>第二组 B GROUP</th>
			        <th>第三组 C GROUP</th>
			        <th>第四组 D GROUP</th>
			        <th>第五组 E GROUP</th>
			        <th>开始时间 START</th>
			        <th>结束时间 E-N-D</th>
			    </tr>
			</thead>
			<tbody id="resultlist">
			    <tr>
			    </tr>
			</tbody>
        </table>
    </div>

    <div class="btn-toolbar">
        <!-- <button id="start"   type="button" class="btn btn-primary">查询</button> -->
        <button id="refresh" type="button" class="glyphicon glyphicon-refresh btn btn-success"></button>
        <button id="new" 	 type="button" class="glyphicon glyphicon-plus btn btn-info" data-toggle="modal" data-target="#newResult"></button>
	    <div class="input-group col-lg-2" style="padding-left: 5px">
	    	<span class="input-group-btn">
	    		<button id="delete" class="glyphicon glyphicon-minus btn btn-warning" type="button" data-toggle="modal"></button>
	    	</span>
	    	<input id="id" type="text" class="glyphicon form-control" placeholder="#"></input>
	    	<span class="input-group-btn">
	    		<button id="edit" class="glyphicon glyphicon-edit btn btn-primary" type="button" data-toggle="modal"></button>
	    	</span>
	    </div>
 	</div>

    <!-- Modal -->
	<div class="modal fade" id="newResult" tabindex="-1" role="dialog" aria-labelledby="newResultLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		        <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span>
			        </button>
			        <h4 class="modal-title" id="newResultLabel">New Result</h4>
		        </div>
		        <div class="modal-body">
		            <form class="form-horizontal">
		            	<div class="form-group">
			          		<label for="a_group" class="col-sm-2 control-label">A Group</label>
			          		<div class="col-sm-10">
			          			<input type="text" class="form-control" id="a_group" placeholder="Jack Liu, Leo Tang, Xiaodong Kou, Javen Chen">
		          	    	</div>
		          	    </div>
		          	    <div class="form-group">
			          		<label for="b_group" class="col-sm-2 control-label">B Group</label>
			          		<div class="col-sm-10">
			          			<input type="text" class="form-control" id="b_group" placeholder="Adam Kong, Zhen Feng, Chen Jing, Kevin Wei">
			          		</div>
		          	    </div>
			          	<div class="form-group">
			          		<label for="c_group" class="col-sm-2 control-label">C Group</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="c_group" placeholder="Willie Zhu, Sun Yu, Eric Wang, Lu Zhang">
			          		</div>
			          	</div>
			          	<div class="form-group">
			          		<label for="d_group" class="col-sm-2 control-label">D Group</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="d_group" placeholder="Michael Jiang, Michael Zhang, Seven Chen, Joey Yin">
			          		</div>
			          	</div>
			          	<div class="form-group">
			          		<label for="e_group" class="col-sm-2 control-label">E Group</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="e_group" placeholder="Jun Xing, Qi Wei, Li Chao, Xinyu Zou">
			          		</div>
			          	</div>
			          	<div class="form-group">
			          		<label for="start_time" class="col-sm-2 control-label">Start</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="start_time" placeholder="2016-06-30">
			          		</div>
			          	</div>
			          	<div class="form-group">
			          		<label for="end_time" class="col-sm-2 control-label">End</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="end_time" placeholder="2016-6-30">
			          	    </div>
			          	</div>
		      	    </form>
		        </div>
		        <div class="modal-footer">
		        	<div id="status" class="alert alert-success">
  						<strong>Created Result Successfully!</strong>
					</div>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary" id="save">Save</button>
		        </div>
		    </div>
	    </div>
	</div>
	<!--Edit Result-->
	<div class="modal fade" id="editResult" tabindex="-1" role="dialog" aria-labelledby="editResultLabel" aria-hidden="true" data-show="false">
	    <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		        <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span>
			        </button>
			        <h4 class="modal-title" id="editResultLabel">Edit Result</h4>
		        </div>
		        <div class="modal-body">
		            <form class="form-horizontal">
		            	<div class="form-group">
			          		<label for="edit_id" class="col-sm-2 control-label">#</label>
			          		<div class="col-sm-10">
			          			<input type="text" class="form-control" id="edit_id" readonly>
		          	    	</div>
		          	    </div>
		            	<div class="form-group">
			          		<label for="edit_a_group" class="col-sm-2 control-label">A Group</label>
			          		<div class="col-sm-10">
			          			<input type="text" class="form-control" id="edit_a_group">
		          	    	</div>
		          	    </div>
		          	    <div class="form-group">
			          		<label for="edit_b_group" class="col-sm-2 control-label">B Group</label>
			          		<div class="col-sm-10">
			          			<input type="text" class="form-control" id="edit_b_group">
			          		</div>
		          	    </div>
			          	<div class="form-group">
			          		<label for="edit_c_group" class="col-sm-2 control-label">C Group</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="edit_c_group">
			          		</div>
			          	</div>
			          	<div class="form-group">
			          		<label for="edit_d_group" class="col-sm-2 control-label">D Group</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="edit_d_group">
			          		</div>
			          	</div>
			          	<div class="form-group">
			          		<label for="edit_e_group" class="col-sm-2 control-label">E Group</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="edit_e_group">
			          		</div>
			          	</div>
			          	<div class="form-group">
			          		<label for="edit_start_time" class="col-sm-2 control-label">Start</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="edit_start_time">
			          		</div>
			          	</div>
			          	<div class="form-group">
			          		<label for="edit_end_time" class="col-sm-2 control-label">End</label>
			          		<div class="col-sm-10">
			          			<input class="form-control" id="edit_end_time">
			          	    </div>
			          	</div>
		      	    </form>
		        </div>
		        <div class="modal-footer">
		        	<div id="edit_status" class="alert alert-success">
  						<strong>Edited Result Successfully</strong>
					</div>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary" id="update">Save</button>
		        </div>
		    </div>
	    </div>
	</div>

	<!--delete result modal-->
	<div class="modal fade" id="delResult" tabindex="-1" role="dialog" aria-labelledby="delResultLabel" aria-hidden="true" data-show="false">
	    <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		        <div class="modal-header alert-danger">
			        <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span>
			        </button-->
			        <h4 class="modal-title" id="delResultLabel">Note: Delete Operation Cannot Be Recovered!</h4>
		        </div>
		        <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			        <button type="button" class="btn btn-primary" id="del_confirm">Confirm</button>
		        </div>
		    </div>
	    </div>
	</div>

	<!--货源ID未指定警告框-->
	<div class="modal fade" id="alert" tabindex="-1" role="dialog" data-show="false">
	    <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		        <div class="modal-header alert-warning">
			        <h4 class="modal-title">Need to specify ID！</h4>
		        </div>
		        <div class="modal-footer">
			        <button type="button" class="btn btn-success" data-dismiss="modal">Got it</button>
		        </div>
		    </div>
	    </div>
	</div>

	<!--货源不存在提示框-->
	<div class="modal fade" id="non_exist_alert" tabindex="-1" role="dialog" data-show="false">
	    <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		        <div class="modal-header alert-warning">
			        <h4 class="modal-title">Non-exist Result！</h4>
		        </div>
		        <div class="modal-footer">
			        <button type="button" class="btn btn-success" data-dismiss="modal">Got it</button>
		        </div>
		    </div>
	    </div>
	</div>

    <!-- jQuery -->
    <script src="bnbs/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bnbs/js/bootstrap.min.js"></script>
    
    <!-- Underscore JavaScript -->
    <script src="bnbs/js/underscore-min.js"></script>

    <!-- Backbone JavaScript -->
    <script src="bnbs/js/backbone-min.js"></script>

    <!-- Backgrid JavaScript -->
    <script src="bnbs/js/backgrid.js"></script>

    <!-- Backbone Paginator JavaScript -->
    <script src="bnbs/js/backbone.paginator.min.js"></script>

    <!-- Results JS -->
    <script src="bnbs/js/result.js"></script>
</div>
</body>

</html>
