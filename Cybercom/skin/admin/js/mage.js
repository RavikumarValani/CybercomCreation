
var Base = function() {

};
Base.prototype = {

    url : null,
    params : {},
    method : 'post',
    form : null,
    setUrl : function(url) {
        this.url = url;
        return this;
    },
    getUrl : function() {
        return this.url;
    },

    setParams : function(params) {
        this.params = params;
        return this;
    },
    getParams : function(key) {
        if(typeof key === 'undefined')
        {
            return this.params;
        }
        if(typeof this.params[key] == 'undefined')
        {
            return null;
        }
        return this.params[key];
    },
    resetParams : function() {
        this.params = {};
        return this;
    },
    addParam : function(key, value) {
        this.params[key] = value;
        return this;
    },
    removeParam : function(key) {
        if(typeof this.params[key] != 'undefined')
        {
            delete this.params[key];
        }
        return this;
    },

    setMethod : function(method) {
        this.method = method;
        return this;
    },
    getMethod : function() {
        return this.method;
    },

    setForm : function(formId) {
        this.form = formId;
        this.setFormData();
        return this;
    },
    getForm : function(){
        return this.form;
    },

    load : function(){
        var self = this;
        var request = $.ajax({
            method: this.getMethod(),
            url: this.getUrl(),
            data: this.getParams(),
            success : function(response) {
                self.manageHtml(response);
            }
          });
          
    },

  

    manageHtml : function(response) {
        if(response === 'undefine')
        {
            alert(null);
        }
        if(typeof response.element == 'object')
        {
            $(response.element).each(function(i, element) {
                $(element.selector).html(element.html);     
            })
        }
        else
        {
            // $(response.element.selector).html(response.element.html);
        }
    },

    setFormData : function(){
        this.setUrl($(this.getForm()).attr('action'));
        this.setMethod($(this.getForm()).attr('method'));
        this.setParams($(this.getForm()).serializeArray());
        return this;
    },

    setCms : function(){
        var formId = '#'+$('form').attr('id');
        CMSContent = CKEDITOR.instances['CMSPage[content]'].getData();
        
        this.setParams($(formId).serializeArray());
        this.setUrl($(formId).attr('action'));
        this.setMethod($(formId).attr('method'));

        $.each(this.params, function(i,val){
            if(val['name'] == 'CMSPage[content]'){
                val['value'] = CMSContent;
            } 
        });

        return this;
    },

    uploadFile : function(){
        var data = new FormData();
        var file = $('#media')[0].files;
        form.append('product', file[0]);
    }
}

var mage = new Base();
mage.setUrl('http://localhost:8080/cybercom1/index.php?c=index&a=index') ;
mage.load();
