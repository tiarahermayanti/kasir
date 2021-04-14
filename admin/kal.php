<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>
<body>

 

  <div class="container">

   <div id="calendar"></div>

  </div>

 </body>
 <script>

  $(document).ready(function() {

   var calendar = $('#calendar').fullCalendar({

    editable:true,

    header:{

     left:'prev,next today',

     center:'title',

     right:'month,agendaWeek,agendaDay'

    },

    events: 'load.php',

    selectable:true,

    selectHelper:true,

    // Insert

    select: function(start, end, allDay){

     var title = prompt("Enter Event Title");

     if(title){

      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");

      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

      $.ajax({

       url:"insert.php",

       type:"POST",

       data:{title:title, start:start, end:end},

       success:function(){

        calendar.fullCalendar('refetchEvents');

        alert("Event Berhasil Ditambahkan!");

       }

      })

     }

    },

    // Event Update

    editable:true,

    eventResize:function(event){

     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");

     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

     var title = event.title;

     var id = event.id;

     $.ajax({

      url:"update.php",

      type:"POST",

      data:{title:title, start:start, end:end, id:id},

      success:function(){

       calendar.fullCalendar('refetchEvents');

       alert('Event Berhasil Di Update');

      }

     })

    },

    eventDrop:function(event){

     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");

     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

     var title = event.title;

     var id = event.id;

     $.ajax({

      url:"update.php",

      type:"POST",

      data:{title:title, start:start, end:end, id:id},

      success:function(){

       calendar.fullCalendar('refetchEvents');

       alert("Event Berhasil Di Update");

      }

     });

    },

    // Event Click Hapus

    eventClick:function(event){

     if(confirm("Apakah yaki ingin dihapus?")){

      var id = event.id;

      $.ajax({

       url:"delete_kal.php",

       type:"POST",

       data:{id:id},

       success:function(){

        calendar.fullCalendar('refetchEvents');

        alert("Event Berhasil di Hapus");

       }

      })

     }

    }

   });

  });

  </script>
</html>