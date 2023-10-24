const dotsColor = '#383838';

export const Dark = {
    palette: {
        mode: 'dark',
        primary: {
            main: '#B37BB7',
        },
        secondary: {
            main: '#E6D1DD',
        },
        accent: {
            main: '#97537A'
        }
    },
    components: {
        MuiCssBaseline: {
            styleOverrides: (themeParam) => ({
                body: themeParam.palette.mode === 'dark' ? {backgroundImage: `radial-gradient(circle, ${dotsColor} 10%, transparent 11%),radial-gradient(circle at bottom left, ${dotsColor} 5%, transparent 6%),radial-gradient(circle at bottom right, ${dotsColor} 5%, transparent 6%),radial-gradient(circle at top left, ${dotsColor} 5%, transparent 6%),radial-gradient(circle at top right, ${dotsColor} 5%, transparent 6%)`} : null,
}),
        },
    },
};