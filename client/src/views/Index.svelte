<script lang="ts">
import { navigate } from 'svelte-routing';
</script>
<div class="container">
	<div class="main">
		<div class="large">Welcome to Atlantique</div>
		<div>A place where you can share your knowledge about frontend and backend web development.</div>
		<button on:click={() => navigate('/blogs/new')}>
			Create New
		</button>
		<img src="/waves.svg" alt="waves" class="waves">
	</div>
</div>
<style lang="scss">
.container {
	height: 100%;
	.main {
		display: grid;
		gap: 10px;
		height: inherit;
		align-content: center;
		.large {
			font-family: Cinzel;
			font-size: 2.25rem;
			font-weight: 700;
		}
	}
	.waves {
		position: absolute;
		bottom: 80px;
		left: 0;
		z-index: -1;
	}
}
button {
	justify-self: start;
	padding: 10px 20px;
	margin: 1rem 0;
}
</style>
