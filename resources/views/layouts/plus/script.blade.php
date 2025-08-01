<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    
<script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script class="include" type="text/javascript" src="{{ asset('lib/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('lib/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('lib/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/jquery.sparkline.js') }}"></script>
<!--common script for all pages-->
<script src="{{ asset('lib/common-scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('lib/gritter/js/jquery.gritter.js') }}"></script>
<script type="text/javascript" src="{{ asset('lib/gritter-conf.js') }}"></script>
<!--script for this page-->
<script src="{{ asset('lib/sparkline-chart.js') }}"></script>
<script src="{{ asset('lib/zabuto_calendar.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    var unique_id = $.gritter.add({
    // (string | mandatory) the heading of the notification
    title: 'Welcome to izyGest!',
    // (string | mandatory) the text inside the notification
    text: 'Heureux de vous revoir {{ Auth()->User()->name }}' ,
    // (string | optional) the image to display on the left
    image: '{{ asset(Auth()->User()->cheminImage) }}',
    // (bool | optional) if you want it to fade out on its own or just sit there
    sticky: false,
    // (int | optional) the time you want it to be alive for before fading out
    time: 8000,
    // (string | optional) the class name you want to apply to that specific message
    class_name: 'my-sticky-class'
    });

    return false;
});
</script>
<script type="application/javascript">
$(document).ready(function() {
    $("#date-popover").popover({
    html: true,
    trigger: "manual"
    });
    $("#date-popover").hide();
    $("#date-popover").click(function(e) {
    $(this).hide();
    });

    $("#my-calendar").zabuto_calendar({
    action: function() {
        return myDateFunction(this.id, false);
    },
    action_nav: function() {
        return myNavFunction(this.id);
    },
    ajax: {
        url: "show_data.php?action=1",
        modal: true
    },
    legend: [{
        type: "text",
        label: "Special event",
        badge: "00"
        },
        {
        type: "block",
        label: "Regular event",
        }
    ]
    });
});

function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
}

</script>

{{-- 
<link href="{{ asset('lib/advanced-datatable/css/demo_page.css')}}" rel="stylesheet" />
  <link href="{{ asset('lib/advanced-datatable/css/demo_table.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('lib/advanced-datatable/css/DT_bootstrap.css')}}" />

  <script src="{{ asset('lib/jquery/jquery.min.js')}}"></script>
  <script type="{{ asset('text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js')}}"></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{ asset('lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{ asset('lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{ asset('lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <script type="{{ asset('text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
  <script type="{{ asset('text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js')}}"></script>
  <!--common script for all pages-->
  <script src="{{ asset('lib/common-scripts.js')}}"></script>
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }

    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
       */
      var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });

      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
      $('#hidden-table-info tbody td img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
          this.src = "lib/advanced-datatable/media/images/details_open.png";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
          this.src = "lib/advanced-datatable/images/details_close.png";
          oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
      });
    });
  </script> --}}