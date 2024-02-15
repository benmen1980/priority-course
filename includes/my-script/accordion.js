jQuery(document).ready(function($) {

    //open accordion
    $('.comment-form .submit').val('שלח');
    $(".single-lesson-wraper .title-and-arrow").click(function() {
            $(this).siblings('.container-lesson').slideToggle();

    });

    //open popup to register

    $(".single-lesson-wraper .display-popup").click(function() {
        $(".show").fadeIn();

    });
    $("span, .overlay").click(function () {
        $(".show").fadeOut();
    });

    //display exercises , solution and more-notes

    $('button.exercises').click(function (){
        $('div.solution').css("display", "none");
        $('div.more_notes').css("display", "none");
        $('div.exercises').css("display", "block");
        $('button.exercises').toggleClass('active');
        $('button.solution').removeClass('active');
        $('button.more_notes').removeClass('active');

    });
    $('button.solution').click(function (){
        $('div.exercises').css("display", "none");
        $('div.more_notes').css("display", "none");
        $('div.solution').css("display", "block");
        $('button.solution').toggleClass('active');
        $('button.exercises').removeClass('active');
        $('button.more_notes').removeClass('active');

    });
    $('button.more_notes').click(function (){
        $('div.exercises').css("display", "none");
        $('div.solution').css("display", "none");
        $('div.more_notes').css("display", "block");
        $('button.more_notes').toggleClass('active');
        $('button.exercises').removeClass('active');
        $('button.solution').removeClass('active');

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


jQuery(document).ready(function($) {

    // מאפס את האש כדי שלא יגלל העמוד בעת הוספת תגובה, זה לא עובד טוב.
    // מבטלת פה את הבררת מחדל של הטופס השארת תגובה
    window.location.hash=null;

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