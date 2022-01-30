import NextNProgress from 'nextjs-progressbar'
import resolveConfig from 'tailwindcss/resolveConfig'

import tailwindConfig from '@/../tailwind.config'
import '@/styles/globals.css'

const colors = resolveConfig(tailwindConfig).theme.colors

function MyApp({ Component, pageProps = {} }) {
  return (
    <>
      <NextNProgress
        color={colors.indigo[600]}
        height={2}
        options={{ showSpinner: false }}
      />
      <Component {...pageProps} />
    </>
  )
}

export default MyApp
