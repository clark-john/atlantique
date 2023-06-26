<script lang="ts">
const imageBadgeLinks: string[] = [
	"https://img.shields.io/badge/svelte-%23f1413d.svg?style=for-the-badge&logo=svelte&logoColor=white",
	"https://img.shields.io/badge/SCSS-hotpink.svg?style=for-the-badge&logo=SASS&logoColor=white",
	"https://img.shields.io/badge/typescript-%23007ACC.svg?style=for-the-badge&logo=typescript&logoColor=white",
	"https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white"
]
</script>

<main>
	<div class="title">About <b>Atlantique</b></div>
	<div>This project is built for fun and effort, also this is my first Svelte project ever. Unfortunately, this may be not responsive for mobile.</div>
	<ul>
		<div style="margin: 10px 0;">Stack List:</div>
		{#each imageBadgeLinks as link}
			<img src={link} alt="">
		{/each}
	</ul>
</main>
<style lang="scss" scoped>
.title {
	font-family: Cinzel;
	font-size: 2.25rem;
	b {
		font-family: Cinzel;
	}
}
main {
	display: grid;
	gap: 10px;
	height: 100%;
	align-content: center;
}
ul {
	margin: 0;
}
</style>
