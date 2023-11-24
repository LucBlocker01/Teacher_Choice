const dotsColor = '#383838';

export const Dark = {
    palette: {
        mode: 'dark',
        primary: {
            main: '#3f2b41',
        },
        secondary: {
            main: '#6b5365',
        },
        accent: {
            main: '#5b3248'
        },
        text: {
            main: '#ffffff'
        },
        background: {
            main: '#000000'
        },
    },
    typography: {
        fontFamily: 'Lato'
    },
    components: {
        MuiCssBaseline: {
            styleOverrides: (themeParam) => ({
                body: themeParam.palette.mode === 'dark' ? {backgroundImage: `radial-gradient(circle, ${dotsColor} 10%, transparent 11%),radial-gradient(circle at bottom left, ${dotsColor} 5%, transparent 6%),radial-gradient(circle at bottom right, ${dotsColor} 5%, transparent 6%),radial-gradient(circle at top left, ${dotsColor} 5%, transparent 6%),radial-gradient(circle at top right, ${dotsColor} 5%, transparent 6%)`} : null,
}),
        },
    },
};