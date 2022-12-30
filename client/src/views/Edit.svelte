<script lang=ts>
import BlogForm from 'components/BlogForm.svelte';

export let id!: number;
</script>

<BlogForm 
	postId={id}
	pageTitle={`Edit Blog ${id}`}
	submitButtonText="Edit"
	loadingText="Editing"
	successText="Edited"
	forEditing={true}
/>
