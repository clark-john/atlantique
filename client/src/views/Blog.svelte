<script lang="ts">
import SvelteMarkdown from 'svelte-markdown';
import dayjs from 'dayjs';
import Readotron from '@untemps/svelte-readotron';

export let id!: number;

const blog = new Promise((resolve, reject) => {
	fetch(`${import.meta.env.VITE_SERVER_URL}/blog?id=${id}`)
	.then(x => {
		if (x.status === 404) {
			reject(`Blog ${id} not found`);
		}
		return x.json();
	})
	.then(x => resolve(x))
	.catch(_err => {
		reject("An error occurred");
	});
});

</script>

{#await blog}
	Loading...
{:then { title, content, created_at, category, tags }}
	<div>	
		<h1>{title}</h1>
		<div>Category: <b>{category}</b></div>
		<div style="margin: 7px 0;">{dayjs(new Date(created_at)).format("MMMM D, YYYY h:mm A")}</div>
		<div style="display: flex; align-items: center; gap: 6px; margin: 9px 0;">
			<img 
				src="https://cdn-icons-png.flaticon.com/512/992/992700.png" 
				width="20"
				style="filter: invert(1);"
				alt="clock"
			>
			<Readotron selector='.text' lang='en' />
		</div>
		<div class='tags'>
			{#if tags}
				Tags:
				{#each tags.split(";") as tag}
					<div class='tag'>{tag}</div>
				{/each}
			{/if}
		</div>
	</div>
	<div class="divider"></div>
	<div class='text'>
		<SvelteMarkdown source={content} />
	</div>
{:catch error}
	{error}
{/await}

<style lang="scss">
.tags {
	margin: 10px 0;
	display: flex;
	align-items: center;
	gap: 4px;
	.tag {
		background-color: #0f0080;
		padding: 3px 9px;
		border-radius: 1rem;
	}
}
</style>
