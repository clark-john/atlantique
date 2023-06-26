<script lang="ts">
import { Link } from 'svelte-routing';
</script>
<div class="navbar">
	<Link class="title" to="/">Atlantique</Link>
	<div class="links">
		<Link to="/about">About</Link>
		<Link to="/blogs">Blogs</Link>
		<Link to="/blogs/new">New</Link>
	</div>
</div>