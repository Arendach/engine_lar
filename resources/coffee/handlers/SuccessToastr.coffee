SuccessToastr = (title, message) ->
  toastr.options.escapeHtml = true
  toastr.options.closeButton = true
  toastr.options.closeMethod = 'fadeOut'
  toastr.options.closeDuration = 300
  toastr.options.closeEasing = 'swing'
  toastr.options.showMethod = 'slideDown'
  toastr.options.hideMethod = 'slideUp'
  toastr.options.closeMethod = 'slideUp'

  toastr.success(message, title)

module.exports = SuccessToastr