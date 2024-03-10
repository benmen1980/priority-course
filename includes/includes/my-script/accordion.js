jQuery(document).ready(function($) {


    $('.comment-form .submit').val('שלח');
    //open accordion
    $(".single-lesson-wraper .title-and-arrow").click(function() {
        if ($(this).siblings('.container-lesson').is(":visible")){
            $(this).siblings('.container-lesson').slideUp();
        }
        else {
            $('.container-lesson').slideUp();
            $(this).siblings('.container-lesson').slideToggle();
            $('button.summary').trigger("click");
            $('button.summary').addClass('active');
            $('button.summary').css("display", "block");
        }

    });

    //open popup to register

    $(".single-lesson-wraper .display-popup").click(function() {
        $(".show").fadeIn();

    });
    $("span, .overlay").click(function () {
        $(".show").fadeOut();
    });

    //display exercises , solution and more-notes

    $('.buttons-tabs-textarea button').click(function (){
        buttonID = $(this).attr('id');
        $('div.'+buttonID).css("display", "block");
        $('div.'+buttonID).siblings('.textarea-tab').css("display", "none");
        $(this).siblings('button').removeClass('active');
        $(this).toggleClass('active');
    });


    //open comment
    $('.button-to-comment').click(function (){
        $('.mylessonComments').toggleClass('comment-open');

    });

    //script-ajax add to cart

    jQuery(document).ready(function($) {
        $('.add-to-cart-button').on('click', function(e) {
            e.preventDefault();

            // SKU או מקט של המוצר שברצונך להוסיף לעגלת הקניות
            var product_sku = $(this).data('sku');
            $('div.'+product_sku).addClass('maslul-active');
            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.ajax_url,
                data: {
                    'action': 'add_product_to_cart',
                    'product_sku': product_sku
                },
                success: function(response) {
                    // במידה וההוספה לעגלה בוצעה בהצלחה, ננווט לעמוד הקניות
                    window.location.href = wc_add_to_cart_params.cart_url;
                }
            });
        });
    });


})

window.onload = function() {
    // בדיקה אם יש hash בכתובת URL
    if(window.location.hash) {
        // אם יש, נקבע את ה־slug של הכתובת URL
        var hash = window.location.hash.substring(1); // הורדת סימן ה#
        var params = hash.split('?')[0]; // מנתחים את המחרוזת לפי השאלון ונותנים ערך למערך params
        var slug = params.split('&').find(p => p.startsWith('post=')).split('=')[1]; // משיגים את הערך מהפרמטר המתאים לנו
        // טעינת העמוד באמצעות ה־slug במקום ה־hash
        window.location.href = "/" + slug;
    }
};
jQuery(document).ready(function($) {



    //  שליטה על עיצוב אובייקט מחוץ לשורטקוד שלא ידרס עמודים אחרים
     $('.my-accordion').parent().css("padding","0");
    $('.shop-of-course').parent().css("padding","0");


// בדיקה אם העמוד הנוכחי מכיל SLUG של COURSE
var currentPath = window.location.pathname;
var courseSlug = '/course-priority'; // ה-SLUG של ה-COURSE שאתה מחפש

if (currentPath.includes(courseSlug)) {
    // אם העמוד הנוכחי מכיל SLUG של COURSE

    // גישה לאלמנט עם class="row" באמצעות jQuery
    var $rowElement = $('.row');

    if ($rowElement.length > 0) {
        // אם נמצא אלמנט עם class="row"
        $('.row').css("max-width","100%");
        console.log('נמצא אלמנט עם class="row" בעמוד עם SLUG של course-priority');
        // כאן תוכל לבצע פעולות נוספות על האלמנט
    } else {
        console.log('לא נמצא אלמנט עם class="row" בעמוד עם SLUG של course-priority');
    }
} else {
    console.log('העמוד הנוכחי אינו עם SLUG של COURSE');
}
});