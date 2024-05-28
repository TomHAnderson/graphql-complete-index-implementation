const { pages } = await import(`./pages.mjs?id=${Math.random()}`)

export default {
    introspection: {
        type: 'none',
    },
    website: {
        template: 'carbon-multi-page',
        output: '../../public/docs',
        options: {
            siteRoot: `/docs`,
            appTitle: 'LDOG Stack',
            appFavicon: 'https://raw.githubusercontent.com/API-Skeletons/ldog/2.0.x/public/assets/icon.png',
            appLogo: 'https://raw.githubusercontent.com/API-Skeletons/ldog/2.0.x/public/assets/smalllogo.png',
            siteMeta: {
                description:
                    'A PHP Stack with Laravel, Doctrine ORM, and GraphQL.',
                'og:description':
                    'A PHP Stack with Laravel, Doctrine ORM, and GraphQL.',
                keywords:
                    'laravel,doctrine,orm,graphql',
                author: 'API Skeletons, Inc. <contact@apiskeletons.com>',
                'og:title': 'LDOG Stack',
                'og:type': 'article',
                'og:image':
                    'https://raw.githubusercontent.com/API-Skeletons/ldog/main/public/assets/share.png',
            },
            pages: pages,
        }
    }
}
