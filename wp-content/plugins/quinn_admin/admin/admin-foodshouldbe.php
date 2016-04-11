<?php

/*
 * CONNECT TO FSB DATABASE
*/

  $host    = 'mysql.quinnpopcorn.com';
  $name    = 'quinn_foodshouldbe';
  $user    = 'quinn_fsb';
  $password = '193DDDDd94zxvNCdsd96ddjFfd1rh';

  // Make a MySQL Connection
  $connection = @mysql_connect($host, $user, $password) or die(mysql_error());
  $db = @mysql_select_db($name,$connection) or die(mysql_error());

	$query = "SELECT terms.term, COUNT(*) AS count
						FROM terms
						GROUP BY term
						";

	$result = mysql_query($query);

	if (false === $result)
	{

		echo mysql_error();

	}

?>
<script type="text/javascript">

jQuery(document).ready(function (){

  var $ = jQuery;
  var t = this;

  function deleteTerm(term) {

    termdata = {'term' : term };

    $.ajax({
        type: "POST",
        data: termdata,
        url: "<?php echo plugin_dir_url( __FILE__ ).'../ajax/foodshouldbe-delete-term.php'; ?>",
        cache: false,
        dataType: "json"
        }).done(function(ajax_data) {
          if (ajax_data == 'success') {
            console.log('success!');
            $('.deleting-term').html('Deleted!').parent().fadeOut();
            return true;
          }
          else {
            return false;
          }

        });
  }


  $('.delete').on('click', function(event){
    event.preventDefault();

    var term = $(this).parent().parent().find('.term').text();

    var alert = window.confirm("Are you sure you want to delete " + term + "?");

    if (alert) {
      $(this).parent().addClass('deleting-term').empty().html('Deleting...');
      deleteTerm(term);
    }
    else {
      console.log('not deleting');
    }

  });

});

</script>
<div class="wrap" id="quinnadmin-foodshouldbe">
  <h2><strong>Quinn Admin</strong> - Food Should Be</h2>
  <hr>

  <p>Below is a list of terms that have been added to the /foodshouldbe database.</p>

  <table class="form-table striped ">

<?php

/* PRINT TERMS */

while( $data = mysql_fetch_array($result) )
{ ?>

<tr>

  <?php echo '<td class="term">' . $data['term'] . '</td>'; ?>
  <td><a href="#" class="delete">[delete]</a></td>

</tr>

<?php } ?>

  </table>


</div>
