<script>
var i = 0;
function startRefresh() {
  $.get('https://api.github.com/users', function(data) {
    $('#content_div_id').append(i + ': ' + data[0].id + '<br>');
    i += 1;
    var myDiv = $('div.portlet-body.chat-widget');
    myDiv.scrollTop(myDiv[0].scrollHeight - myDiv[0].clientHeight);
    setTimeout(startRefresh, 300);
  });
}
$(function () {
  startRefresh();
});
</script>
<style>
#content_div_id {
  width: 50%;
  height: 100px;
  overflow-y: scroll;
}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<div class="portlet-body chat-widget" style="overflow-y: auto; width: auto; height: 300px;">
    <div class="row">
        <div class="col-lg-12">
            <p class="text-center text-muted small">January 1, 2014 at 12:23 PM</p>
        </div>
    </div>

    <div id="content_div_id" style="overflow-y: hidden; width: auto; height: auto;">

    </div>
</div>