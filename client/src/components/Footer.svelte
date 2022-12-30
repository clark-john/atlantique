<script lang='ts'>
import { links } from '@/links';
</script>

<div class="footer">
	<div style="display: grid; grid-row-gap: 10px;">
		Socials
		<div class="social-icons">
			{#each links as {link, icon}}
				<div class="icon">
					<a href={link} target="_blank" class="icon" rel="noreferrer">
						<i class={icon}></i>
					</a>
				</div>
			{/each}
		</div>		
	</div>
	<div>
		<div class="title">Bloggiton</div>
		<div class="small">Place of Web Blogs</div>
	</div>
	<div>&copy; 2022 John Clark. All rights reserved</div>

</div>
<style lang='scss'>
i {
	font-size: 1.75rem;
}
</style>
