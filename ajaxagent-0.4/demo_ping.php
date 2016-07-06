<? 

  // server side function call
  function ping($obj) {
    //$tempobj = array( 'IM');
    //$obj = array_merge ($obj, $tempobj);    
    return $obj;
  }
  
  include_once("agent.php");
  $agent->init(); 
  
?>

<script>

  // callback function for car
  function cb_test(obj) {
    var str = "The team members are ";
    str += obj[0] + ", " + obj[1] ;
    document.getElementById("div_team").innerHTML = str;
  }
 
  // callback function for car
  function cb_car(obj) {
    alert(JSON.stringify(obj));
    str = "My car is a " + obj.color + " " + obj.make + "<br/>";
    document.getElementById("div_car").innerHTML = str;
  }
 
  // callback function for team
  function cb_team(obj) {
    alert(obj);
    var str = "The team members are ";
    str += obj[0] + ", " + obj[1] ;


/*
    var str = "The team members are ";
    str += obj[0]["First Name"] + " (" + obj[0]["Email"] + ")";
    str += " & ";
    str += obj[1]["First Name"] + " (" + obj[1]["Email"] + ") <br/>";
*/
    document.getElementById("div_team").innerHTML = str;
  }

  // defining class Car
  function Car() {
    var color = "";
    var make = "";
  }

  function sendCar() {
    var myCar = new Car();
    myCar.color = "Black";
    myCar.make = "Volvo";
    agent.call("","ping","cb_car",myCar);
  }  

  function sendTeam() {

    var myTeam = [
      {
          "First Name" : "Steve",
          "Last Name" : "Hemmady",
          "Email" : "steve@ajaxagent.org",
          "Phone" : "(555) 555-1212"
      },
      {
          "First Name" : "Anuta",
          "Last Name" : "Udyawar",
          "Email" : "anuta@ajaxagent.org",
          "Phone" : "(555) 555-3434"
      }
    ];
    var myTeam = ["Steve","Anuta"]

    agent.call("","ping","cb_test",myTeam);
  }

</script>
 
<style>
  p { font-size: 12px; font-family: Verdana, Arial; }
  div { font-size: 12px; font-family: Verdana, Arial; color: blue; } 
</style>

<p><b>Demo: Ping</b></p>

<p> 
Click <a href="#" onclick="sendCar()">here</a> to create a car object, 
send it to the server's ping function & then display the car details 
when the response object is pinged back from the server. <br>
<div id="div_car"></div>
</p>

<p>
Click <a href="#" onclick="sendTeam()">here</a> to create an array of 
team members, send it to the server & then display the details 
when the response array is pinged back from the server. <br>
<div id="div_team"></div>
</p>
 