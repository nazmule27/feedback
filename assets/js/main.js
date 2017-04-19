$('#passing_year').change(function () {
    var passing_year = $(this).val();
    $.ajax({
        type: "POST",
        url:"http://localhost/alumni/undergrad_alumni/give_more_data",
        async: false,
        dataType: "json",
        data: "passing_year="+passing_year,
        success: function (response) {
            var obj = response.data;
            try{
                var theDiv = document.getElementById("<ID_OF_THE_DIV>");
                theDiv.innerHTML += "<YOUR_CONTENT>";
                theDiv.appendChild(content);
                //http://stackoverflow.com/questions/5677799/how-to-append-data-to-div-using-javascript
                $.each(obj, function(key){
                    items.push($(str1).text(obj[key].student_id));
                    items.push($(str2).text(obj[key].full_name));
                    items.push($(str3).text(obj[key].student_id));
                    items.push($(str4).text(obj[key].u_university_passing_year));
                    items.push($(str5).text(obj[key].email));
                    items.push($(str6).text(obj[key].location));
                    items.concat($(str6));
                });
                $('#u_con').empty().append(items);

            }catch(e) {
                alert('Exception while request..');
            }
            $('#finalResult').fadeOut('slow', function() {
                $(this).append(str).fadeIn('slow').fadeIn(3000);
                $('#finalResult').css({backgroundColor: ''});
                $('#finalResult').append.apply($('#finalResult'), items);
            }).css({backgroundColor: '#D4ED91'});
        },
        error: function(){ alert('Ooops ... server problem');
        }
    })
});

$('.carousel').carousel({
	interval: 3000
})
function view(img) {
	imgsrc = img.src;
	viewwin = window.open(imgsrc,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=600,height=600");
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_img')
                .attr('src', e.target.result)
                .width(200)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function readPhotoURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#gallery_img')
                .attr('src', e.target.result)
                //.width(200)
        };
        reader.readAsDataURL(input.files[0]);
    }
}

//Created by Nazmul
var mes='<a href="javascript:void(0)" class="infoLink" title="Developer Information"></a><div class="per_InfoWhole"><div class="per_infoBlock"><a href="javascript:void(0)" id="diamond-shield"></a><div class="per_flowRow"><div class="per_leftPart"><h3>Nazmul Haque</h3><p>Asst. Programmer, CSE, BUET</p><div class="per_flowRow"><a href="mailto:nlnazmul@gmail.com?subject=Hello">nlnazmul@gmail.com</a><em>E-mail: &nbsp;</em></div><div class="per_flowRow"><a href="http://www.linkedin.com/profile/view?id=178516225&trk=nav_responsive_tab_profile" target="_blank">LinkedIn Profile</a></div></div><div class="per_rightPart"><div class="per_profile">&nbsp;</div></div></div></div></div>';
document.body.insertAdjacentHTML( 'afterbegin', mes );
$(".infoLink").click(function(){
    $(".per_InfoWhole").slideDown(function(){
        $("#diamond-shield").click(function(){
            $(".per_InfoWhole").slideUp();
        });
    });
});
function isPasswordMatch() {
    var password = $("#new_password").val();
    var confirmPassword = $("#confirmPassword").val();

    if (password != confirmPassword) {
        $("#divCheckPassword").html("Passwords do not match!");
        return false;
    }
    else{
        $("#divCheckPassword").html("");
        return true
    }
}
$("td").click(function () {
    $(this).find('input:radio').attr('checked', true);
});


$('#feedback_form').submit(function () {
    var v = grecaptcha.getResponse();
    if(v.length == 0)
    {
        document.getElementById('msg_captcha').innerHTML="You can't leave Captcha Code empty";
        return false;
    }
    if(v.length != 0)
    {
        /*document.getElementById('msg_captcha').innerHTML="Captcha completed";*/
        return true;
    }
});