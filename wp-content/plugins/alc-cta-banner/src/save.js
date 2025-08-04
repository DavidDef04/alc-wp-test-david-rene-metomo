import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { title, content, buttonUrl, backgroundColor } = attributes;

    return (
        <div {...useBlockProps.save()} style={{ backgroundColor, padding: '2rem' }}>
            <RichText.Content tagName="h2" value={title} />
            <RichText.Content tagName="p" value={content} />
            <a href={buttonUrl} className="wp-block-button__link" aria-label="Call to Action">Appel à l’action</a>
        </div>
    );
}
