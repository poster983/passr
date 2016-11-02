/*

The MIT License (MIT)

Copyright (c) Tue Nov 1 2016 Joseph Hassell joseph@thehassellfamily.net

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORTOR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
/*VARS*/
var submitAdvanText = document.getElementById("submitAdvantext");


$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
$("#sao").change(function() {
    if(this.checked) {
      $('#passrequestAdvanced').show();
        $('#passrequestAdvanced').animateCss('bounceIn');
        submitAdvanText.innerHTML = " (Using Advanced Options) <i class='material-icons right'>error_outline</i>"
    } else {
      $('#passrequestAdvanced').animateCss('bounceOut');
      $('#passrequestAdvanced').one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
    function(e) {
      $('#passrequestAdvanced').hide();
      submitAdvanText.innerHTML = "<i class='material-icons right'>send</i>"
    });
    }
});
