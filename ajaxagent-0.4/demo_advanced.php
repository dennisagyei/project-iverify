<?php 
  // server side function call
  function ajax_hello() {
    $tmp = "Hello World from server! The server time is ".date("H:i:s");
    $tmp .= "\nHello World från servern! Tiden på servern är ".date("H:i:s");
	return $tmp;
  }

  function ajax_delayed_hello() {
    sleep(5);
    $tmp = "Delayed Hello World from server! The server time is ".date("H:i:s");
    $tmp .= "\nFördröjd Hello World från servern! Tiden på servern är ".date("H:i:s");
	return $tmp;
  }

  define('AJAXAGENT_ADVANCED', 1);
  include_once('agent.php');
  $agent->register_prefix('ajax_');
  $agent->options(true, true);
  $agent->agent_process();
  $js = $agent->init_return(); 
  
  echo $js;
?>

<script>
  function call_hello() {
    agent.call('','ajax_hello','callback_hello');
  }
  
  function call_hello_external_url() {
    agent.call('demo_external.php','hello','callback_hello');
  }

  var obj; 
  function call_delayed_hello() {
    obj = agent.call('','ajax_delayed_hello','callback_hello');
  }
   
  function call_hello_sync() {
    str = agent.call('','ajax_hello','');
    alert(str);
  }
  
  function callback_hello(str) {
    alert(str);
  }

</script>

<style>
  p { font-size: 12px; font-family: Verdana, Arial; }
</style>

<p><b>Demo: Hello</b></p>

<p>
  This is a simple demo which calls 'hello' function from the server.  
  Click <a href="#" onclick="call_hello()">here</a> to test.
</p>

<p>
  This one calls 'hello' function from the server but from an external URL. 
  Click <a href="#" onclick="call_hello_external_url()">here</a> to test.
</p>

<p>
  This one calls 'hello' function from the server synchronously.  
  Click <a href="#" onclick="call_hello_sync()">here</a> to test.
</p>

<p>
  This one calls 'delayed hello' function from the server which takes 5 seconds 
  to respond back. Click <a href="#" onclick="call_delayed_hello()">here</a> to 
  test. While waiting for the response, you may chose to
  <a href="#" onclick="obj.abort();AgentWorking(false);">abort</a> the last request to check the 
  'abort' functionality.
</p>

<div id='AjaxWorking' style='position: absolute; top: 200px; left: 300px; display: none; width: 200px; height: 80px; border: 1px solid #000; background-color: #CFC; text-align: center; padding-top: 30px;'>Contacting the server<br>for more information<br><br><b>Please hold...</b></div>
