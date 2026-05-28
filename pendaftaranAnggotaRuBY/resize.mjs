import sharp from 'sharp';
import { statSync } from 'fs';

const images = ['ruby1', 'ruby2', 'ruby3', 'ruby4'];
const dir = 'public/assets/images/';

for (const name of images) {
  const file = `${dir}${name}.webp`;

  await sharp(file)
    .resize({ width: 1200, withoutEnlargement: true })
    .webp({ quality: 70 })
    .toFile(`${dir}${name}_opt.webp`);

  const before = Math.round(statSync(file).size / 1024);
  const after = Math.round(statSync(`${dir}${name}_opt.webp`).size / 1024);
  console.log(`${name}: ${before}KB -> ${after}KB`);
}

console.log('Selesai!');
