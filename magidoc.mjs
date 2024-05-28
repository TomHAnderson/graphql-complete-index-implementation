export default {
    introspection: {
        type: 'url',
        url: 'http://localhost:8080',
    },
    website: {
        template: 'carbon-multi-page',
        output: './public/docs',
        options: {
            siteRoot: `/docs`,
            appTitle: 'LDOG Stack',
            appFavicon: 'https://apiskeletons.com/images/favicon.ico',
            appLogo: 'https://raw.githubusercontent.com/API-Skeletons/ldog/main/public/ldog.svg',
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
                    'https://raw.githubusercontent.com/API-Skeletons/ldog/main/public/ldog.svg',
            },
            pages: [
                {
                    title: 'GraphQL API Docs',
                    content: `
# GraphQL API Docs

This query returns all Artists, Performances, and Recordings in the included sample database.

You may try it out with [graphiql](https://ldog.apiskeletons.dev/graphiql)

\`\`\`graphql
query {
  artists {
    edges {
      node {
        id
        name
        performances {
          edges {
            node {
              date
              venue
              city
              state
              recordings {
                edges {
                  node {
                    source
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
\`\`\`

---

A project of [API Skeletons](mailto:contact@apiskeletons.com)
* https://github.com/api-skeletons/ldog
                    `
                }
            ]
        }
    }
}
