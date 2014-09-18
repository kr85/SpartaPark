@section('script')
    <script type="text/javascript">
        var centreGot = false;
    </script>
	<?php echo $map['js']; ?>
@stop

@section('content')
    <?php echo $map['html']; ?>
    <div id="directionsDiv"></div>
@stop