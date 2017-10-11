<template>
    <div class="panel panel-default"> 
        
                        <div class="panel-heading">{{ page.title }}</div> 
                        <invoice-list></invoice-list>
                       
	</div>
</template>

<script>
module.exports = {
    data: function () {
	    return {
		  page: {
		  	title: "Twoje faktury"
		  }
		}
    }, 
};


</script>
