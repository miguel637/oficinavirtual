var container_required_class = "input-error-required";
var field_required_class = "form-control-error";
var field_required_alert = '<div class="pl-input '+container_required_class+'"><small class="text-danger"><i class="fas fa-exclamation-circle"></i> Campo Obligatorio</small></div>';
function changeTextFieldAlert(newtext)
{
    field_required_alert = '<div class="pl-input '+container_required_class+'"><small class="text-danger"><i class="fas fa-exclamation-circle"></i> '+newtext+'</small></div>';
}
function restoreTextFieldAlert()
{
    field_required_alert = '<div class="pl-input '+container_required_class+'"><small class="text-danger"><i class="fas fa-exclamation-circle"></i> Campo Obligatorio</small></div>';
}
