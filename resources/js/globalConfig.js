let config = {
    refreshRate: 1, // default: refresh every 1 minute
    appName: "Dashboard Monitoring",
};

export const globalConfig = {
    get(key) {
        return config[key];
    },

    set(key, value) {
        config[key] = value;
    },

    getAll() {
        return { ...config }; // return a copy
    },

    formatCompat(dates) {
        if (dates) {
            const date = new Date(dates);
            const ms = [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ];
            return (
                (date.getDate() > 9 ? "" : "0") +
                date.getDate() +
                "-" +
                ms[date.getMonth()] +
                "-" +
                date.getFullYear() +
                "/" +
                (date.getHours() > 9 ? "" : "0") +
                date.getHours() +
                ":" +
                (date.getMinutes() > 9 ? "" : "0") +
                date.getMinutes()
            );
        }
        return "";
    },

    formatDate(dates) {
        var date = new Date(dates);
        var ms = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ];
        var result =
            (date.getDate() > 9 ? "" : "0") +
            date.getDate() +
            "-" +
            ms[date.getMonth()] +
            "-" +
            date.getFullYear();
        return result;
    },
};
