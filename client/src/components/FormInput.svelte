<script lang=ts>
import type { Field } from 'svelte-forms/types';

export let type: string = 'text';
export let displayLabel: string;
export let label: string;
export let field: Field<any> = null;
export let minlength: number = null;
export let value: any = '';

const addType = (node: HTMLInputElement) => {
	node.type = type;
}

const validationObject: { [key: string]: string } = {
	required: "This field is required",
	min: `This field requires ${minlength} characters.`
};

</script>

<div class='input'>
	<label for={label}>{displayLabel}</label>
	{#if type !== "textarea"}
		<input 
			use:addType 
			bind:value={value} 
			class:invalid={field.invalid}
		>
		{#each field.errors as e}
			<div class='validation_message'>
				{validationObject[e]}
			</div>
		{/each}
	{:else}
		<textarea 
			bind:value={value} 
			class:invalid={field.invalid}
			rows="10" 
		></textarea>
		{#each field.errors as e}
			<div class='validation_message'>
				{validationObject[e]}
			</div>
		{/each}
	{/if}	
</div>

<style lang="scss" scoped>
input, textarea {
	border-style: none;
	border-radius: 1px;
	padding: 7px 10px;
	font-size: 1rem;
	outline: none;
}
textarea {
	resize: none;
}
.input {
	display: grid;
	row-gap: 4px;
	width: 100%;
}
.validation_message {
	color: #ff4040;
}
.invalid {
	outline: 2px red solid;
}
</style>