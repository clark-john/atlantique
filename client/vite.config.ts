import { defineConfig } from 'vite';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import path from 'path';

const alias = [];
const folders = ['views', 'components', 'assets'];
for (const folder of folders) {
  alias.push({
    find: folder,
    replacement: path.resolve(__dirname, `./src/${folder}`)
  });
}
alias.push({
  find: "@",
  replacement: path.resolve(__dirname, './src')
});

export default defineConfig({
  plugins: [svelte()],
  resolve: { alias }
});
