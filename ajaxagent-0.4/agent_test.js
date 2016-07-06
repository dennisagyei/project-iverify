var test_one_text="Test text &едц+"; 
var test_23_text = "<strong>Hello World!</strong>";

var obj = Array();
	obj[0] = "Test text";
	obj[1] = true;
	obj[2] = 1;

var obj2 = Array();
	obj2[0] = "Test text"; 
	obj2[1] = true;
	obj2[2] = 1;
	obj2[3] = "&едц+";

var failed = 0;
var passed = 0;

function load_app(){
	test_1();
//	show_sum();
}

function test_1(){
	agent.call('', 'ajax_return_str', 'callback_test_1', test_one_text);
}

function callback_test_1(str){
	var tmp = "Test 1 ( Send string to php and return it, async ) ";
	if(str==test_one_text){
		tmp += "pass! ( "+str+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+str+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_2();
}

function test_2(){
	var str = agent.call('', 'ajax_return_str', '', test_one_text);
	var tmp = "Test 2 ( Send string to php and return it, sync ) ";
	if(str==test_one_text){
		tmp += "pass! ( "+str+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+str+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_3();
}

function test_3(){
	var str = agent.call('', 'ajax_get_str', '', 'latin');
	var tmp = "Test 3 ( Get a string from php, latin, sync ) ";
	if(str==test_one_text){
		tmp += "pass! ( "+str+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+str+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_4();
}

function test_4(){
	var str = agent.call('', 'ajax_get_str', '', 'utf8');
	var tmp = "Test 4 ( Get a string from php, UTF8, sync ) ";
	if(str == test_one_text){
		tmp += "pass!( "+str+" ) <br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+str+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_5();
}

function test_5(){
	var ret_obj = agent.call('', 'ajax_return_obj', '', obj);
	var tmp = "Test 5 ( Get an array from php, sync ) ";
	if(ret_obj[0] == "Test text" && ret_obj[1] == true && ret_obj[2] == 1){
		tmp += "pass! ( "+ret_obj+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+ret_obj+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_6();
}

function test_6(){
	agent.call('', 'ajax_return_obj', 'callback_test_6', obj);
}

function callback_test_6(ret_obj){
	var tmp = "Test 6 ( Get an array from php, async ) ";
	if(ret_obj[0] == "Test text" && ret_obj[1] == true && ret_obj[2] == 1){
		tmp += "pass! ( "+ret_obj+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+ret_obj+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_7();
}

function test_7(){
	var ret_obj = agent.call('', 'ajax_return_obj', '', obj2);
	var tmp = "Test 7 ( Get an array from php, sync ) ";
	if(ret_obj[0] == obj2[0] && ret_obj[1] == obj2[1] && ret_obj[2] == obj2[2] && ret_obj[3] == obj2[3]){
		tmp += "pass! ( "+ret_obj+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+ret_obj+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_8();
}

function test_8(){
	var ret_obj = agent.call('', 'ajax_get_obj', '', 'latin');
	var tmp = "Test 8 ( Get an array from php, latin, sync ) ";
	if(ret_obj[0] == obj2[0] && ret_obj[1] == obj2[1] && ret_obj[2] == obj2[2] && ret_obj[3] == obj2[3]){
		tmp += "pass! ( "+ret_obj+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+ret_obj+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_9();
}

function test_9(){
	var ret_obj = agent.call('', 'ajax_get_obj', '', 'utf8');
	var tmp = "Test 9 ( Get an array from php, UTF8, sync ) ";
	if(ret_obj[0] == obj2[0] && ret_obj[1] == obj2[1] && ret_obj[2] == obj2[2] && ret_obj[3] == obj2[3]){
		tmp += "pass! ( "+ret_obj+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+ret_obj+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_10();
}

function test_10(){
	var res = agent.call('', 'ajax_put_obj', '', obj);
	var tmp = "Test 10 ( Sending obj to php, sync: "+obj+" ) ";
	if(res == 1){
		tmp += "pass! ( "+obj+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+obj+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_11();
}

function test_11(){
	var res = agent.call('', 'ajax_put_obj', '', obj2);
	var tmp = "Test 11 ( Sending obj to php, sync: "+obj2+" ) ";
	if(res == 1){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_12();
}

function test_12(){
	var res = agent.call('', 'ajax_get_snuff', '');
	var tmp = "Test 12 ( Get a snuff from php, sync ) ";
	if(res == 'text " text'){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_13();
}

function test_13(){
	var res = agent.call('', 'ajax_get_snuff', '', 'utf8');
	var tmp = "Test 13 ( Get a snuff from php, UTF8, sync ) ";
	if(res == 'text " text'){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_14();
}

function test_14(){
	var res = agent.call('', 'ajax_get_snuff', '', 'arr1');
	var tmp = "Test 14 ( Get a array with snuff, sync ) ";
	if(res[0] == 'text " text' && res[1] == 1){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_15();
}

function test_15(){
	var res = agent.call('', 'ajax_get_snuff', '', 'arr2');
	var tmp = "Test 15 ( Get a array with snuff, sync ) ";
	if(res[0] == "text ' text" && res[1] == 1){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed! ( "+res+" )</b><br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_16();
}

function test_16(){
	var res = agent.call('', 'ajax_put_snuff', '', 'text " text &едц+', 'str1');
	var tmp = "Test 16 ( Putting array to php, sync: "+'text " text &едц+'+" ) ";
	if(res == 1){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_17();
}

function test_17(){
	var res = agent.call('', 'ajax_put_snuff', '', "text ' text &едц+", 'str2');
	var tmp = "Test 17 ( Send two strings to php, sync: "+"text ' text &едц+"+" ) ";
	if(res == 1){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_18();
}

function test_18(){
	var obj3 = Array();
	obj3[0] = 'text " text &едц+';
	obj3[1] = 1;
	var res = agent.call('', 'ajax_put_snuff', '', obj3, 'arr1');
	var tmp = "Test 18 ( Send a array to php, sync: "+obj3+" ) ";
	if(res == 1){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_19();
}

function test_19(){
	var obj3 = Array();
	obj3[0] = "text ' text &едц+";
	obj3[1] = 1;
	var res = agent.call('', 'ajax_put_snuff', '', obj3, 'arr2');
	var tmp = "Test 19 ( Send a array to php, UTF8, sync: "+obj3+" ) ";
	if(res == 1){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_20();
}

function test_20(){
	var obj3 = Array();
	obj3[0] = 123;
	obj3[1] = 'abc"d"efg';
	var res = agent.call('', 'ajax_get_snuff_in_array', '');
	var tmp = "Test 20 ( Get an array with snuff ) ";
	if(res[0] == obj3[0] && res[1] == obj3[1]){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_21();
}

function test_21(){
	var res = agent.call('', 'ajax_updateclock', '');
	var tmp = "Test 21 ( Return time, sync) ";
	if(res.length == 11){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_22();
}
function test_22(){
	agent.call('', 'ajax_updateclock', 'callback_test_22');
}

function callback_test_22(res){
	var tmp = "Test 22 ( Return time, async) ";
	if(res.length == 11){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_23();
}

function test_23(){
	agent.call('', 'ajax_get_html', 'html_test');
	var res = agent.call('', 'ajax_get_html', '');
	var tmp = "Test 23 ( get some html, sync ) ";
	if(res == test_23_text){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_24();
}

function test_24(){
	var res = agent.call('', 'ajax_get_html', 'callback_test_24');
}

function callback_test_24(res){
	var tmp = "Test 24 ( get some html, async ) ";
	if(res == test_23_text){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_25();
}

function test_25(){
	var tmp = "Test 25 ( put some html in a div, async ) ";
	if(document.getElementById('html_test').innerHTML.toUpperCase() == test_23_text.toUpperCase()){
		tmp += "pass! ( "+document.getElementById('html_test').innerHTML+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+document.getElementById('html_test').innerHTML+" )<br>";
		failed++;
	}
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_26();
}

function test_26(){
	var tmp = "Test 26 ( check add_slashes, sync ) ";
	var res = agent.call('', 'ajax_add_slashes', '', "Kalle'");
	if(res == 1){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}	
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_27();
}

function test_27(){
	var tmp = "Test 27 ( murray return, sync ) ";
	var res = agent.call('', 'ajax_get_murray', '');
	if(res === "form action=\"java script:savetab1('co_')\" name='co_form' method='post' enctype='multipart/form-data'"){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}	
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_28();
}

function test_28(){
	var tmp = "Test 28 ( murray return array, sync ) ";
	var res = agent.call('', 'ajax_get_murray_array', '');
	if(res[0] === "form action=\"java script:savetab1('co_')\" name='co_form' method='post' enctype='multipart/form-data'"){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}	
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_29();
}

function test_29(){
	var tmp = "Test 29 ( returning an php error, sync ) ";
	var res = agent.call('', 'ajax_get_error', '');
	if(res != false){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}	
	document.getElementById('test').innerHTML += tmp;
	show_score();
	test_30();
}

function test_30(){
	agent.call('', 'ajax_get_error', 'callback_test_30');
}

function callback_test_30(res){
	var tmp = "Test 30 ( returning an php error, async ) ";
	if(res != false){
		tmp += "pass! ( "+res+" )<br>";
		passed++;	
	}else{
		tmp += "<b>failed!</b> ( "+res+" )<br>";
		failed++;
	}	
	document.getElementById('test').innerHTML += tmp;
	show_score();
	show_sum();
}

function show_sum(){
	var tmp = "<br><b>Total passed: "+passed+"<br>";
	tmp += "Total failed: "+failed+"<br>";
	if (failed>0){
		tmp += "Something is smelling...<br>";
	}else{
		tmp += "Yeah, it's all good!<br>";
	}
	document.getElementById('test').innerHTML += tmp;
}

function show_score(){
	var tests = passed + failed;
	var tmp = "<table  style='background-color:#e99;'><tr><td>Number of tests:</td><td>"+tests+"</td><td>Passed:</td><td>"+passed+"</td>";
	tmp += "<td>Failed:</td><td>"+failed+"</td></tr></table>";
	
	document.getElementById('score').innerHTML = tmp;
}