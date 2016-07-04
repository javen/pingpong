# CRDC PingPong Project
Pingping Pongpong: Practice is addictive!

# Develop Tools
1. PHP 5.4 or greater
2. CodeIgniter 3.2
3. Bootstrap 3
4. Backbone 

# Deployment
1. MySQL 5.5/5.6
2. Apache2
3. NodeJS any (for view showing)

# Usage
1. CRUD via browser: http:/ip.addr.of.host/pingpong
2. via RESTful API
** curl -X GET http:/ip.addr.of.host/pingpong/api/results
** curl -H "Content-Type: application/json" -X POST -d '{"a_group": "Leo Adam Jack Zhen", "b_group": "Willie Kevin Javen Eric", "c_group": "Joey Seven Yu Lu", "d_group": "Michael Jun", "e_group": "--", "start_time": "2016-3-21", "end_time": "2016-3-25"}' http:/ip.addr.of.host/pingpong/api/results/id
** curl -H "Content-Type: application/json" -X PUT -d '{"d_group": "--"}' http:/ip.addr.of.host/pingpong/api/results/id/1
** curl -X DELETE http:/ip.addr.of.host/pingpong/api/results/id/1