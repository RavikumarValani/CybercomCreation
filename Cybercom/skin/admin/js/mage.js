
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
        this.setParams($(formId).serialize());
        this.setMethod($(formId).attr('method'));
        this.setUrl($(formId).attr('action'));
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
            $(response.element.selector).html(response.element.html);
        }
    },

    uploadFile : function () {
        var form_data = new FormData();
        var file = $("#file")[0].files;
        form_data.append('image', file[0]);
        this.setParams(form_data);
        self = this;
        var request = $.ajax({
            method : this.getMethod(),
            url : this.getUrl(),
            contentType : false,
            processData : false,
            data : this.getParams(),
            success : function (response) {
                self.manageHtml(response);
            }
        });          
        return this;
    }
}

var mage = new Base();