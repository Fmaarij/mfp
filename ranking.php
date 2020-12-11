<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/36ffd44000.js" crossorigin="anonymous"></script>

</head>
<div>
    <div align="center" style=" padding: 20px">
        <i class="fa fa-star fa-1x" data-index="0"></i>
        <i class="fa fa-star fa-1x" data-index="1"></i>
        <i class="fa fa-star fa-1x" data-index="2"></i>
        <i class="fa fa-star fa-1x" data-index="3"></i>
        <i class="fa fa-star fa-1x" data-index="4"></i>
    </div>
</div>
<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    var ratedIndex = -1,
        uID = 0;
    $(document).ready(function() {
        resetStarColors();

        if (localStorage.getItem('ratedIndex') != null)
            setStars(parseInt(localStorage.getItem('ratedIndex')));

        $('.fa-star').on('click', function() {
            ratedIndex = parseInt($(this).data('index'));
            localStorage.setItem('ratedIndex', ratedIndex)
        });

        $('.fa-star').mouseover(function() {
            resetStarColors();
            var currentIndex = parseInt($(this).data('index'));
            setStars(currentIndex);
        });
        $('.fa-star').mouseleave(function() {
            resetStarColors();

            if (ratedIndex != -1)
                setStars(ratedIndex);


        });
    });




    function setStars(max) {
        for (var i = 0; i <= max; i++)
            $('.fa-star:eq(' + i + ')').css('color', 'green');
    }

    function resetStarColors() {
        $('.fa-star').css('color', 'white');
    }
</script>

</html>