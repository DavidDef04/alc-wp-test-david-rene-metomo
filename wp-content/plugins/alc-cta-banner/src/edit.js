import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const { title, content, buttonUrl, backgroundColor } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title="Options">
                    <TextControl
                        label="Lien du bouton"
                        value={buttonUrl}
                        onChange={(val) => setAttributes({ buttonUrl: val })}
                    />
                    <ColorPalette
                        label="Couleur de fond"
                        value={backgroundColor}
                        onChange={(val) => setAttributes({ backgroundColor: val })}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...useBlockProps()} style={{ backgroundColor: backgroundColor, padding: '2rem' }}>
                <RichText
                    tagName="h2"
                    value={title}
                    onChange={(val) => setAttributes({ title: val })}
                    placeholder="Titre"
                />
                <RichText
                    tagName="p"
                    value={content}
                    onChange={(val) => setAttributes({ content: val })}
                    placeholder="Texte"
                />
                <a href={buttonUrl} className="wp-block-button__link" aria-label="Call to Action">Appel à l’action</a>
            </div>
        </>
    );
}
