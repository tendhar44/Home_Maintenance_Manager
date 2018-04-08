

 	/*
        ENLARG IMAGE METHOD:
        required the following tag in html file

        <img id="myImg" class="img">

        <div id="myModel" data-imgId="img# class="img-modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="enlargeImg">
        <div id="caption"></div>

        */

    //using jquery
    $(function() {

    	var model = document.getElementById('myModel');
    	var modalImg = document.getElementById("enlargeImg");
    	var captionText = document.getElementById("caption");
    	var span = document.getElementsByClassName("close")[0];

    	$('.img').on('click', function() {
    		modal.style.display = "block";
    		modalImg.src = $(this).prop('src')
    		captionText.innerHTML = $(this).attr("alt");


    	});

    	$('.close').on('click', function() {
    		modal.style.display = "none";
    	});



    });