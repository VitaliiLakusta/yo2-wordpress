

var gCanvas = null;

var gMaskImg = null;
var gMaskImgUrl = '../wp-content/themes/Divi/img/transparent_mask_optimized.png';

var gUserImg = null;
var gUserImgUrl = '../wp-content/themes/Divi/img/pug.jpg';

(function() {
  var canvas = this.__canvas = new fabric.Canvas('c');
  // canvas.calcOffset();
  fabric.Object.prototype.transparentCorners = false;
  
  var padding = 0;
  canvas.setHeight(700);
  canvas.setWidth(900);


  fabric.Image.fromURL(gUserImgUrl, function(img) {
    gUserImg = img;

    img.lockRotation = false;
    img.scaleToWidth(1000);
    img.top=0;
    img.left=0;
    img.lockUniScaling = true;
    img.setOpacity(1);
    canvas.add(img);
  });

  

  // UPLOAD MASK IMAGE : MAKE IT STATIC, NOT MOVABLE
  fabric.Image.fromURL(gMaskImgUrl, function(img) {

    gMaskImg = img;
    img.evented = false;
    img.lockRotation = true;
    img.lockMovementX = true;
    img.lockMovementY = true;
    img.scaleToWidth(canvas.getWidth());
    img.selectable = false; // GOOD STUFF
    img.top=0;
    img.left=0;
    img.setOpacity(0.72);
    canvas.add(img);
    canvas.setHeight(img.getHeight());

  });

  gCanvas = canvas;
    
})();

function saveModifications() {
  console.log("saveModifications is called");


  // ------------------AJAX CALL TO THE SERVER TO CONNECT TO WOOCOMMERCE API AND MAKE THE PAYMENT------------------------------
  $.post("../hello-world.php", {data: "foo"}, function(results){
      alert(results);
  } );

    //window.open(gCanvas.toDataURL('.png'));
    //window.open(gUserImg.toDataURL('.png'));
}  

function setUserImage()
{
    console.log("before the function");
    var imgUrl=document.getElementById('imgUrl').value;
    fabric.Image.fromURL(imgUrl, function(img) {
      img.lockRotation = false;
      img.scaleToWidth(800);
      img.top=0;
      img.left=0;
      img.lockUniScaling = true;
      gCanvas.remove(gUserImg);
      gCanvas.add(img);
      gUserImg = img;
      gCanvas.moveTo(img, 0);
  });
}


document.getElementById('uploadedImg').onchange = function handleImage(e) {
  var reader = new FileReader();
    reader.onload = function (event){
      var imgObj = new Image();
      imgObj.src = event.target.result;
      imgObj.onload = function () {
        var image = new fabric.Image(imgObj);
        image.set({
              lockRotation:false,
              lockUniScaling:true
        });
        image.scaleToWidth(600);
        // gCanvas.remove(gUserImg);    // YOU DON'T HAVE TO REMOVE THE PREV IMAGE AFTER ADDING THE NEW ONE
        gCanvas.add(image);
        gCanvas.centerObject(image);
        gUserImg = image;
        gCanvas.moveTo(image, 0);
        gCanvas.bringToFront(image);
        gCanvas.bringToFront(gMaskImg);
        gCanvas.renderAll();
      }
    }
  reader.readAsDataURL(e.target.files[0]);
}

function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
    s4() + '-' + s4() + s4() + s4();
}

function removeSelectedImage() {
    gCanvas.remove(gCanvas.getActiveObject());
}

function clearCanvas() {
    if (confirm("Are you sure you want to clear the canvas?") == true)
        gCanvas.clear();
}

function bringForward() {
    gCanvas.bringForward(gCanvas.getActiveObject());
}

function sendBackwards() {
    gCanvas.sendBackwards(gCanvas.getActiveObject());
}

function sendToBack() {
    gCanvas.sendToBack(gCanvas.getActiveObject());
}

function bringToFront() {
    gCanvas.bringToFront(gCanvas.getActiveObject());
    gCanvas.bringToFront(gMaskImg);
}

function resetPositions() {
    gCanvas.forEachObject(function(o) {
        gCanvas.centerObject(o);
    });
}

function chooseFile() {
    $("#uploadedImg").click();
}