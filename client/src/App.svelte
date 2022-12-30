<script>
import { Router, Route } from 'svelte-routing';
import About from 'views/About.svelte';
import Index from 'views/Index.svelte';
import NotFound from 'views/NotFound.svelte';
import Blog from 'views/Blog.svelte';
import New from 'views/New.svelte';
import Edit from 'views/Edit.svelte';
import Blogs from 'views/Blogs.svelte';
import Markdown from 'views/Markdown.svelte';
import Navbar from 'components/Navbar.svelte';
import Footer from 'components/Footer.svelte';
</script>

<Router>
	<div class="wrapper">
		<Navbar />
		<div class='body'>
			<Route path="/"><Index /></Route>
			<Route path="/about"><About /></Route>
			<Route path="/markdown"><Markdown /></Route>
			<Route path="/blogs"><Blogs /></Route>
			<Route path="/blogs/new"><New /></Route>
			<Route path="/blogs/edit/:id" let:params><Edit id={params.id} /></Route>
			<Route path="/blogs/:id" let:params><Blog id={params.id} /></Route>
			<Route path="*"><NotFound /></Route>		
		</div>
		<Footer />		
	</div>
</Router>
