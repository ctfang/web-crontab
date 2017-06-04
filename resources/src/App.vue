<template>
	<div id="app" class="container">
		<router-view></router-view>
	</div>
</template>

<script>
	export default {
		name: 'app'
	}
</script>

<style>
	a{ 
		text-decoration:none
	} 
	html{
		width:100%;
		height:100%;
	}
	body {
		width:100%;
		height:100%;
		margin: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		margin-left: 0px;
	}
	.container{
		width:100%;
		height:100%;
	}
	.block{
		background-color:#fff;
		padding:30px;
	}
</style>
