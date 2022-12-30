<script lang="ts">
// components
import Loading from 'components/LoadingSubmitText.svelte';
import FormInput from 'components/FormInput.svelte';

// types
import type { Field } from 'svelte-forms/types';
import type { WritableStringField } from '@/types';

import { onMount } from 'svelte';
import { field } from 'svelte-forms';
import { required, min } from 'svelte-forms/validators';

// props with default values
export let postId = null;
export let forEditing = false;
export let submitButtonText = 'Submit';
export let successText = 'Submitted';
export let loadingText = 'Submitting';
export let pageTitle = 'Create New Blog';

const titleInput = field('title', '', [required(), min(3)]);
const contentInput = field('content', '', [required()]);
const categoryInput = field('category', '', [required()]);
const tagsInput = field('tags', '', []);

const requiredFields: WritableStringField[] = [titleInput, contentInput, categoryInput];
const fields = [...requiredFields, tagsInput];

// submission related
let submitText = submitButtonText;
let isFetching = false;
let isFound = true;
let isError = false;

onMount(() => {
	if (forEditing) {
		fetch(`${import.meta.env.VITE_SERVER_URL}/blog?id=${postId}`)
			.then(x => {
				if (x.status === 404){
					isFound = false;
					return;
				}
				return x.json();
			})
			.catch(_err => {
				isError = true;
			})
			.then(x => {
				for (let field of fields) {
					let name = '';
					field.subscribe((x: Field<string>) => {
						name = x.name;
					});
					field.set(x[name]);
				}
			});
	}
});

$: isValid = $titleInput.valid && $contentInput.valid && $categoryInput.valid;

const createBlog = async () => {
	const fmdata = new FormData();
	for await (const { validate } of requiredFields){
		validate();
	}
	for (const { subscribe } of fields) {
		subscribe(({ name, value }) => {
			fmdata.append(name, value);
		});
	}
	if (postId) {
		fmdata.append("post_id", postId);
	}
	const url = import.meta.env.VITE_SERVER_URL;
	if (isValid) {
		isFetching = true;
		fetch(`${url}/${forEditing ? 'update' : 'create'}`, {
			method: 'POST',
			body: fmdata
		})
			.then((x: Response) => {
				isFetching = false;
				submitText = successText;
				return x.status === 204 ? x.text() : x.json();
			})
			.catch(err => {
				isFetching = false;
				submitText = "Error";
				console.log(err);
			});
	}
}

</script>

<div class='title'>{pageTitle}</div>

{#if !isError && isFound}
<form on:submit|preventDefault={createBlog}>
	<FormInput 
		bind:value={$titleInput.value}
		label='title' 
		displayLabel='Title' 
		field={$titleInput}
		minlength={3}
		
	/>
	<FormInput
		bind:value={$contentInput.value}
		type="textarea" 
		label='content' 
		displayLabel='Content'
		field={$contentInput}
	/>
	<a href={`/markdown?data=${window.btoa($contentInput.value)}`} target="_blank" rel="noreferrer" style:justify-self="end">
		Show in Markdown
	</a>
	<div class="a">
		<FormInput 
			label='category' 
			displayLabel='Category'
			field={$categoryInput}
			bind:value={$categoryInput.value}
		/>
		<FormInput 
			bind:value={$tagsInput.value}
			label='tags'
			displayLabel='Tags (separate with semicolons)' 
			field={$tagsInput}
		/>
	</div>
	<button type="submit">
		{#if isFetching}
			<Loading text={loadingText} />
		{:else}
			{submitText}
		{/if}
	</button>
</form>
{:else if !isFound && !isError}
	<div style:text-align='center'>Blog {postId} Not Found</div>
{:else}
	<div style:text-align='center'>An error occurred</div>
{/if}

<style lang=scss>
$input-gap: 12px;
form {
	width: 80%;
	margin: 0 auto;
	display: grid;
	height: 80%;
	row-gap: $input-gap;
	button[type=submit] {
		justify-self: start;
		border-style: none;
		border-radius: 8px;
		font-size: inherit;
		text-align: center;
		width: 20%;
		transition: filter 200ms;
		&:hover {
			filter: brightness(.75);
		}
	}
}
.a {
	display: flex;
	gap: $input-gap;
}
</style>
