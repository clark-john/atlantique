<script lang='ts'>
import { onMount, onDestroy } from 'svelte';

let interval: ReturnType<typeof setInterval> = null;
let dots = '';

export let text = 'Submitting';

onMount(() => {
	interval = setInterval(() => {
		if (dots.length === 3) {
			dots = '';
		}
		dots += '.';
	}, 500);
});
onDestroy(() => {
	clearInterval(interval);
});

</script>
<div>{text}{dots}</div>
