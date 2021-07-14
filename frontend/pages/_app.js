import "../styles/globals.css";
import { Container } from "@material-ui/core";

function MyApp({ Component, pageProps }) {
    return (
        <Container>
            <Component {...pageProps} />
        </Container>
    );
}

export default MyApp;
