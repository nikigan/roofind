module.exports = {
    async rewrites() {
        return {
            fallback: [
                {
                    source: "/api/:path*",
                    destination: "http://building.loc/api/:path*",
                },
            ],
        };
    },
};
