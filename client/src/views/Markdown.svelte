<script lang="ts">
import SvelteMarkdown from 'svelte-markdown';

const url = new URL(window.location.href);

const source = window.atob(url.searchParams.get("data"));
</script>

<SvelteMarkdown source={source} />
