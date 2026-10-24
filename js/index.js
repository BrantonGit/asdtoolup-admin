var receiptImages = document.querySelectorAll(".receiptrow img");
var receiptJumbo = document.querySelector(".receiptGallJumbo");

for (var i = 0; i < receiptImages.length; i++) {
    receiptImages[i].addEventListener(
        "click",
        function(e) {
            receiptJumbo.src = "/uploads/lrg-" + e.target.id;
        },
        false
    );
}

var tradeinImages = document.querySelectorAll(".tradeinrow img");
var tradeinJumbo = document.querySelector(".tradeinGallJumbo");

for (var i = 0; i < tradeinImages.length; i++) {
    tradeinImages[i].addEventListener(
        "click",
        function(e) {
            tradeinJumbo.src = "/uploads/lrg-" + e.target.id;
        },
        false
    );
}


//Lucas' Stuff
var historyComments = document.querySelectorAll('.history-section .table-row .item-content a');
var updateSvgs = document.querySelectorAll('.updateStatus button');

for(var i = 0; i< updateSvgs.length;i++){
    updateSvgs[i].addEventListener('click', toggleView, false)
}

for(var i = 0; i< historyComments.length; i++){
    historyComments[i].addEventListener('click', toggleComments, false)
}


function toggleComments(e){

    e.preventDefault();
    var vm = this;
    var selected = vm.dataset.target;
    var comments = document.querySelector(".comment-lightbox[data-comments='"+selected+"']");
    comments.classList.toggle('visible-flex');
    comments.querySelector('.close-comment').addEventListener('click', function(e){
            e.preventDefault();
            comments.classList.remove('visible-flex');
        
    })
}
function toggleView(e){
    //Toggle the visibility of each admin review section
    e.preventDefault();
    var vm = e.currentTarget;
    var dataTarget = vm.dataset.target;
    var target = document.querySelector(".submitReview[data-name="+"'"+dataTarget+"-review']");
    if(target.classList.contains('visible')){
        target.classList.remove('visible');
    } else {
        target.classList.toggle('visible');
        return watchSelect(target, dataTarget);
    }
    
    
}

function watchSelect(target, dataTarget){
    var options = target.querySelector('.section-status select');
    options.addEventListener('change', function(){
        var activeButton = document.querySelector(".updateStatus button[data-target="+"'"+dataTarget+"'] svg.active");
        if(activeButton){
        activeButton.classList.remove('active');
        }
        if(options.value == 1){
            var status = "pending";
        } else if(options.value == 2){
            var status = "need-info";
        } else if(options.value == 3){
            var status = "declined";
        } else if(options.value == 4){
            var status = "approved";
        }
        
        if(status != "pending"){
            var currentButton = document.querySelector(".updateStatus button[data-target="+"'"+dataTarget+"'] svg."+status);
            currentButton.classList.toggle('active');
        }
        var header = document.querySelector(".statusBar[data-section-head="+"'"+dataTarget+"']");
        header.dataset.status = "status-"+options.value;
        var status = null;
        return updateReviewSignOff(target, dataTarget, options.value);
    }, 
    false);
    
}

function updateReviewSignOff(target, dataTarget, status){
    var selected = document.querySelector(".double-check ul li[data-section-review="+"'"+dataTarget+"'] img");
    selected.src = "/3M/asd-admin/images/icons/"+status+"-status-icon.svg";
}
// window.location.host : you'll get sub.domain.com:8080 or sub.domain.com:80
// window.location.hostname : you'll get sub.domain.com
// window.location.protocol