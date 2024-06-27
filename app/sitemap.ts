import type { MetadataRoute } from "next";
import { url } from "@/utils/metadata";
import { getPages } from "./source";

export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
	return [
		{
			url: url("/"),
			lastModified: new Date(),
			priority: 1,
			alternates: {
				languages: {
					zh: `${url("/")}cn`,
					en: `${url("/")}en`,
				},
			},
		},
		...getPages().map<MetadataRoute.Sitemap[number]>((page) => {
			return {
				url: url(page.url),
				alternates: {
					languages: {
						zh: `${url("/")}cn${page.url}`,
						en: `${url("/")}en${page.url}`,
					},
				},
				lastModified: page.data.exports.lastModified
					? new Date(page.data.exports.lastModified)
					: undefined,
				changeFrequency: "weekly",
				priority: 0.8,
			};
		}),
	];
}
