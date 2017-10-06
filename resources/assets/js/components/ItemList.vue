<template>
	<div>

		<button type="button" @click="addItem"> Dodaj element</button>

        <item-row v-for="(task,index) in tasks" :key="index" v-bind:item="task">
        	#{{ index }}{{ task.task }} <span v-if="task.complete">(done)</span>
			<button type="button" @click="removeItem(index)"> X </button>
        </item-row>
	
	</div>
</template>


<script>
// Task list template
module.exports = {
	data: function () {
	return {
	  tasks: [
	    {task: 'mall1', complete: true},
	    {task: 'mall2', complete: false},
	    {task: 'mall3', complete: false}
	  ]
	};
	},
	methods: {
		addItem(){
			this.tasks.push({task: 'dodane', complete: true})
		},
		removeItem(index){
			this.tasks.splice(index,1)
		}
	}
};

</script>