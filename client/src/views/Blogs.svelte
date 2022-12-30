<script lang=ts>
import Card from 'components/Card.svelte';

const list: Promise<Array<Record<string, any>>> = new Promise((resolve, reject) => {
	fetch(`${import.meta.env.VITE_SERVER_URL}/blogs`)
		.then(x => x.json())
		.then(x => {
			resolve(x);
		})
		.catch(_err => {
			reject("An error occurred");
		});
});

</script>

<div class='container'>
	{#await list}
		Loading blogs...
	{:then ls}
		{#if ls.length}
			{#each ls as x}
				<Card blogObject={x} />
			{/each}
		{:else}
			There are no blogs right now.
		{/if}
	{:catch err}
		{err}
	{/await}
</div>

<style>
.container {
	margin: 1.5rem 0;
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 13px;
}
</style>