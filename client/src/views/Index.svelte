<script lang="ts">
import { navigate } from 'svelte-routing';
</script>
<div class="container">
	<div class="main">
		<div class="large">Welcome to Bloggiton</div>
		<div>A place where you can share your knowledge about frontend and backend web development.</div>
		<button on:click={() => navigate('/blogs/new')}>
			Create New
		</button>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class='waves'>
			<path fill="#000944" fill-opacity="1" d="M0,192L24,176C48,160,96,128,144,133.3C192,139,240,181,288,186.7C336,192,384,160,432,160C480,160,528,192,576,202.7C624,213,672,203,720,202.7C768,203,816,213,864,192C912,171,960,117,1008,112C1056,107,1104,149,1152,186.7C1200,224,1248,256,1296,229.3C1344,203,1392,117,1416,74.7L1440,32L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
		</svg>
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
