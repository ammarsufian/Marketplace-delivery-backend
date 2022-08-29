// max maxlength textarea
document.getElementById('maxlength').maxLength = '255';
document.getElementById('maxlength').onkeyup = function() {
    var max = 255;
    if (this.value.length > max) {
        this.value = this.value.substring(0, max);
    }
}