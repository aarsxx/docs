import createMDX from 'fumadocs-mdx/config';

const withMDX = createMDX();

/** @type {import('next').NextConfig} */
const config = {
  reactStrictMode: true,
  async redirects() {
		return [
			{
				source: '/',
				destination: '/docs/core/get-started/introduction',
				permanent: true,
			},
		]
	},
};

export default withMDX(config);
