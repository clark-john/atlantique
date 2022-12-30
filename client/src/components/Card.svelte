<script lang="ts">
import dayjs from 'dayjs';
import type { Blog } from '@/types';
import { Link } from 'svelte-routing';

export let blogObject: Partial<Blog> = {};

const { id, title, category, created_at, tags }  = blogObject;

const deleteBlog = () => {
	if (confirm('Are you sure?')) {
		fetch(`${import.meta.env.VITE_SERVER_URL}/delete?id=${id}`, {
			method: 'DELETE'
		});
		window.location.reload();		
	}
}
</script>

<div class='card'>
	<h3>{title}</h3>
	<div>Category: <b>{category}</b></div>
	<div>Created At: <b>{dayjs(Date.parse(created_at)).format("MMMM D, YYYY h:mm A")}</b></div>
	{#if tags}
		<div class="tags">
			<span>Tags:</span>
			<div class="tags-container">
				{#each tags.split(';') as tag}
					<div class="tag">{tag}</div>
				{/each}
			</div>
		</div>
	{/if}		
	<div class='links'>
		<Link to={`/blogs/${id}`}>Read more</Link>
		<Link to={`/blogs/edit/${id}`}>Edit</Link>
		<button class='delete-link' on:click={deleteBlog}>Delete</button>	
	</div>
</div>

<style lang='scss'>
@use "../styles/colors.scss" as c;

.card {
	background-color: lighten(c.$bg-color, 1%);
	border-radius: 20px;
	display: grid;
	align-content: space-evenly;
	padding: 1rem 1.25rem;
	h3 {
		margin: 9px 0;
	}
	.links {
		display: flex;
		margin: 1rem 0;
		margin-bottom: 0;
		justify-self: end;
	}
	.delete-link {
		padding: 0;
		margin: 0;
		background-color: transparent;
		color: c.$links-color;
		font-size: 1rem;
		border: none;
	}
	.tags {
		margin: 1rem 0;
		display: flex;
		align-items: center;
		gap: 8px;
		.tags-container {		
			display: flex;
			gap: 3px;
			.tag {
				background-color: #0f0080;
				padding: 3px 9px;
				border-radius: 1rem;
			}
		}
	}
}

</style>
