var formAdmin	= '#adminForm';

// SUBMIT FORM ADMIN
function submitFormAdmin(url){
	if(url != ""){
		$(formAdmin).attr('action',url);
	}
	$(formAdmin).submit();
}

// SORT LIST
function sortList(orderBy, order){
	$(formAdmin + ' input[name=order]').val(order);
	$(formAdmin + ' input[name=order_by]').val(orderBy);
	submitFormAdmin();
}

// CHANGE STATUS
function changeStatus(id, status){
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "status");
	$(formAdmin + ' input[name=status_id]').val(id);
	$(formAdmin + ' input[name=status_value]').val(status);
	submitFormAdmin(linkSubmit);
}

//CHANGE SHOW
function changeShow(id, show){
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "show");
	$(formAdmin + ' input[name=show_id]').val(id);
	$(formAdmin + ' input[name=show_value]').val(show);
	submitFormAdmin(linkSubmit);
}

//CHANGE MENU
function changeMenu(id, menu){
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "menu");
	$(formAdmin + ' input[name=menu_id]').val(id);
	$(formAdmin + ' input[name=menu_value]').val(menu);
	submitFormAdmin(linkSubmit);
}

// CHANGE GROUP ACP
function changeGroupACP(id, groupACP){
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "groupACP");
	$(formAdmin + ' input[name=status_id]').val(id);
	$(formAdmin + ' input[name=status_value]').val(groupACP);
	submitFormAdmin(linkSubmit);
}

// CHANGE SPECIAL
function changeSpecial(id, special){
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "special");
	$(formAdmin + ' input[name=status_id]').val(id);
	$(formAdmin + ' input[name=status_value]').val(special);
	submitFormAdmin(linkSubmit);
}

//CHANGE MULTI STATUS
function changeMultiStatus(type){
	$(formAdmin + ' input[name=status_value]').val(type);
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "multi-status");

	submitFormAdmin(linkSubmit);
}
	
//CHANGE MULTI SHOW
function changeMultiShow(type){
	$(formAdmin + ' input[name=show_value]').val(type);
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "multi-show");
	submitFormAdmin(linkSubmit);
}

//CHANGE MULTI MENU
function changeMultiMenu(type){
	$(formAdmin + ' input[name=menu_value]').val(type);
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "multi-menu");
	submitFormAdmin(linkSubmit);
}

// SHOW TOTAL ITEM CHECK
function showTotalItemCheck(total){
	$('a[data-show-item=yes] span').remove();
	if(total > 0){
		$('a[data-show-item=yes]').prepend('<span class="badge bg-aqua">'+total+'</span>');
	}
}

// DELETE ITEM
function deleteItem(){
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "delete");
	submitFormAdmin(linkSubmit);
}
function ConfirmDelete() {             
    $('#DeleteModal').modal();                      // initialized with defaults
     return false;
 }
// CHANGE ORDERING
function changeOrdering(){
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "ordering");
	submitFormAdmin(linkSubmit);
}

// CHANGE ACTION
function changeAction(type){
	$(formAdmin + ' input[name=action]').val(type);
	submitFormAdmin();
}

// MOVE NODE
function moveNode(id, type){
	var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "move");
	$(formAdmin + ' input[name=status_id]').val(id);
	$(formAdmin + ' input[name=status_value]').val(type);
	submitFormAdmin(linkSubmit);
}

$(document).ready(function(){
	//Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Phone
	$("[data-mask]").inputmask();
	//STYLE INPUT DROPDOWNLIST
	$("input[name='Sort']").TouchSpin({
        min: 0,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        prefix: 'Số'
    });
	$("input[name='Ngaytrahoso']").TouchSpin({
        min: 0,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        prefix: 'Số'
    });
	//LOAD AJAX
//	$(function() {
//		var homeLoader = $('body').loadingIndicator({
//			useImage: false,
//		}).data("loadingIndicator");
//		
//		setTimeout(function() {
//			homeLoader.hide();
//		}, 300);
//		
	});
	//CONFIRM DELETE ONE ITEM
	$('a[data-confirm]').click(function(ev) {
        var href = $(this).attr('href');

        if (!$('#dataConfirmModal').length) {
            $('body').append('<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
					            <div class="modal-dialog">\
					              <div class="modal-content">\
					                <div class="modal-header">\
					                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
					                  <h4 class="modal-title" id="H3">Xóa bản ghi?</h4>\
					                </div>\
					                <div class="modal-body">\
					                 Bạn có muốn xóa bản ghi này không?\
					                </div>\
					                <div class="modal-footer">\
					                  <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>\
					                  <a type="button" class="btn btn-danger" id="dataConfirmOK">Xóa</a>\
					                </div>\
					              </div>\
					            </div>\
					          </div>');
        } 
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show:true});
        return false;
    });
	var idCurrent	= $(formAdmin + ' input[name=id]').val();
	if(idCurrent > 0) $(formAdmin + ' select[name=parent] option[value='+idCurrent+']').attr("disabled",true);
	
	// TOOLBAR BUTTON CLICK
	$('a[data-type=ordering]').click(function(){ changeOrdering();});
	$('a[data-type=active]').click(function(){ changeMultiStatus(1); });
	$('a[data-type=inactive]').click(function(){ changeMultiStatus(0); });
	$('a[data-type=delete]').click(function(){ deleteItem(); });
	$('a[data-type=save]').click(function(){ changeAction('save'); });
	$('a[data-type=save-close]').click(function(){ changeAction('save-close'); });
	$('a[data-type=save-new]').click(function(){ changeAction('save-new'); });
	
	
	$(".alert").fadeOut(10000);
	var totalItemChecked = 0;
	
	// SELECTBOX filter_category - CHANGE
	$(formAdmin + ' select[name=filter_category]').change(function(){
    	submitFormAdmin();
    });
	
	// SELECTBOX filter_group - CHANGE
	$(formAdmin + ' select[name=filter_group]').change(function(){
    	submitFormAdmin();
    });
	
	// SELECTBOX filter_controller - CHANGE
	$(formAdmin + ' select[name=filter_controller]').change(function(){
    	submitFormAdmin();
    });
	
	// SELECTBOX filter_status - CHANGE
	$(formAdmin + ' select[name=filter_status]').change(function(){
    	submitFormAdmin();
    });
	
	// SELECTBOX filter_special - CHANGE
	$(formAdmin + ' select[name=filter_special]').change(function(){
    	submitFormAdmin();
    });
	
	// SELECTBOX filter_group_acp - CHANGE
	$(formAdmin + ' select[name=filter_group_acp]').change(function(){
    	submitFormAdmin();
    });
	
	// SELECTBOX filter_level - CHANGE
	$(formAdmin + ' select[name=filter_level]').change(function(){
    	submitFormAdmin();
    });
	
	// SELECTBOX filter_count_perpage - CHANGE
	$(formAdmin + ' select[name=filter_count_perpage]').change(function(){
    	submitFormAdmin();
    });
	
	// INPUT filter_keyword_value - KEYPRESS
	$(formAdmin + ' input[name=filter_keyword_value]').keypress(function(event){
		if(event.which == 13){
			event.preventDefault();
			submitFormAdmin();
		}
    });
    
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });

    //When unchecking the checkbox
    $("#check-all").on('ifUnchecked', function(event) {
    	$("input[type='checkbox']").iCheck("uncheck");
    	showTotalItemCheck(0);
    });
    
    //When checking the checkbox
    $("#check-all").on('ifChecked', function(event) {
        $("input[type='checkbox']").iCheck("check");
        var items = $(formAdmin + ' table tbody input[type=checkbox]:checked').length;
        showTotalItemCheck(items);
    });
    
    //When checking the checkbox
    $("table tbody input[type=checkbox]").on('ifChecked', function(event) {
    	totalItemChecked+=1;
    	 showTotalItemCheck(totalItemChecked);
    });
    
    $("table tbody input[type=checkbox]").on('ifUnchecked', function(event) {
    	totalItemChecked-=1;
    	showTotalItemCheck(totalItemChecked);
    });

});