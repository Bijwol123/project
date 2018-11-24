<div class="articles form large-5 medium-8 columns content">
    <h1>Search Article</h1>
    <style type="text/css">
    .error {
        background:#fcc;
    }
    </style>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="/resources/demos/yle.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      
    <?php
        echo $this->Form->create('',['url' => ['action' => 'search'],'id' => 'myform']);
        echo $this->Form->control('title');
        echo $this->Form->control('created',['class' =>'validDate' , 'id'=> 'created', 'autocomplete' => 'off' ]);
        echo $this->Form->control('modified',['class' =>'validDate' , 'id' => 'modified', 'autocomplete' => 'off']);
        echo $this->Form->control('category');
        echo $this->Form->button(__('Search Article'));
        echo $this->Form->end();
    ?>
    <script type="text/javascript">
      $(document).ready(function () {
            $( "#created" ).datepicker({
                dateFormat: "yy/mm/dd"
            });
            $( "#modified" ).datepicker({
                dateFormat: "yy/mm/dd"
            });

            $('#myform').submit(function(event) {
                var created = $('#created').val();
                var modified = $('#modified').val();
                // console.log(created);
                // console.log(modified);
                if (created >= modified) {
                    alert("Oop! Modified must be later than created.");
                    event.preventDefault();
                }
                else {
                    return true;
                }
            });
        });
    </script>
</div>
<!-- <script>
	$( function() {
	    $( "#created" ).datepicker({
            dateFormat: "yy/mm/dd"
        });
	    $( "#modified" ).datepicker({
            dateFormat: "yy/mm/dd"
        });
	});
 </script> -->
 <!-- <script>
    $(function() {
        $( "#created" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat:"yy/mm/dd",
            onClose: function( selectedDate ) {
                $( "#modified" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#modified" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat:"yy/mm/dd",
            onClose: function( selectedDate ) {
                $( "#created" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
    </script> -->
