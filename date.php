<?
$date=date('c');
echo $date;
?>
<script type="text/javascript">
  $( ".elgg-input-date" ).datepicker({minDate:0});
  $("#point_bank").change(function(){
    if($('select#point_bank option:selected').val()=='no'){
      $('select#partial_redemption').attr('disabled', true)
    }
    else
      if($('select#point_bank option:selected').val()=='yes'){
        $('select#partial_redemption').attr('disabled', false);
      }
  })
</script>
